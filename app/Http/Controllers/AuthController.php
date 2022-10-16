<?php

namespace App\Http\Controllers;

use App\Mail\SignUp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use View;
use Illuminate\Support\Facades\Mail;
use Validator;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'verifyEmail']]);
    }
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        if (User::where([
            ['email_verified_at', '=', null],
            ['email', '=', $request->email]
        ])->exists()) {
            return response()->json([
                "error" => "E-mail não confirmado, verifique sua caixa de e-mail!"
            ], 406);
        }
        if (!$token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->createNewToken($token);
    }
    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $base_url = env('APP_URL');
        $hash = md5(rand(0, 1000));
        $link = $base_url . '/' .'validateEmail/' . $hash;
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)],
            ['hash_email' =>  $hash],
        ));
        Mail::to($request->email)->send(new SignUp($request->name, $request->email, $link));
        return response()->json([
            'message' => 'Usuário cadastrado com sucesso!',
            'user' => $user
        ], 201);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Deslogado com sucesso!']);
    }
    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->createNewToken(auth()->refresh());
    }
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile()
    {
        return response()->json(auth()->user());
    }
    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }
    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function verifyEmail($hash)
    {
        if (User::where('hash_email', $hash)->exists()) {
            $usuario = User::where('hash_email', $hash)->first();
            if (is_null($usuario->email_verified_at)) {
                $usuario->email_verified_at = date('Y-m-d H:i:s');
                $usuario->save();
                return View::make('EmailVerified')->with('return', 'E-mail verificado com sucesso!');
                response()->json([
                    "message" => "E-mail verificado com sucesso!"
                ], 200);
            } else {
                return View::make('EmailVerified')->with('return', 'E-mail já verificado.');
                return response()->json([
                    "message" => "E-mail já verificado."
                ], 404);
            }
        }
        return response()->json([
            "message" => "E-mail não cadastrado."
        ], 404);
    }
}
