<?php

namespace App\Http\Controllers;

use App\Mail\SignUp;
use App\Mail\RecoveryPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserTerms;
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
        $this->middleware('auth:api', ['except' => ['login', 'register', 'verifyEmail', 'recoveryPasswordEmail', 'recoveryPassword', 'getUserTerms']]);
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
            return response()->json($validator->errors(), 400);
        }
        if (User::where([
            ['email_verified_at', '=', null],
            ['email', '=', $request->email]
        ])->exists()) {
            return response()->json([
                "error" => "E-mail não confirmado, verifique sua caixa de e-mail!"
            ], 400);
        }
        if (!$token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Usuário/senha inválidos!'], 400);
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
        $base_url = env('APP_URL', 'https://web-reserva-o6jvz.ondigitalocean.app');
        $hash = md5(rand(0, 1000));
        $link = $base_url . '/' . 'validateEmail/' . $hash;
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
            ['user_type' => 'USU'],
            ['status' => 'A'],
        ));
        Mail::to($request->email)->send(new SignUp($request->name, $request->email, $link));
        return response()->json([
            'message' => 'Usuário cadastrado com sucesso, verifique seu e-mail, faça a validação de seu cadastro para depois acessar.',
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
                    "error" => "E-mail já verificado."
                ], 400);
            }
        }
        return response()->json([
            "error" => "E-mail não cadastrado."
        ], 404);
    }
    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function recoveryPasswordEmail(Request $request)
    {
        $hash = md5(rand(0, 1000));
        $data = date('Y-m-d H:i:s');
        $base_url = env('APP_URL');
        $link = $base_url . '/' . 'recoveryPassword/' . $hash;
        if (User::where('email', $request->email)->exists()) {
            $usuario = User::where('email', $request->email)->first();
            $usuario->hash_password = $hash;
            $usuario->hash_password_expires = date('Y-m-d H:i:s', strtotime("+1 days", strtotime($data)));
            $usuario->save();
            Mail::to($request->email)->send(new RecoveryPassword($usuario->name, $request->email, $link));
            return response()->json([
                "message" => "Verifique seu e-mail para redefinir a senha."
            ], 200);
        }
        return response()->json([
            "error" => "Ocorreram erros, tente novamente."
        ], 400);
    }

    public function recoveryPassword(Request $request)
    {

        if (User::where('hash_password', $request->hash)->exists()) {
            $usuario = User::where('hash_password', $request->hash)->first();
            if ((date('Y-m-d H:i:s') <= $usuario->hash_password_expires) && ($request->password != '')) {
                $usuario->password = bcrypt($request->password);
                $usuario->save();
                response()->json([
                    "message" => "E-mail verificado com sucesso!"
                ], 200);
                return View::make('EmailVerified')->with('return', 'Senha alterada com sucesso!');
            } else {
                response()->json([
                    "error" => "Erro ao alterar a senha."
                ], 400);
                return View::make('EmailVerified')->with('return', 'Oops! O link expirou, favor solicite novamente a redefinição de senha.');
            }
        }
        response()->json([
            "error" => "Hash inválido."
        ], 400);
        return View::make('EmailVerified')->with('return', 'Hash inválido.');
    }

    public function createUserTerms(Request $request)
    {
        $termos = new UserTerms();
        $termos->descricao = $request->descricao;
        $termos->situacao = $request->situacao;
        $termos->save();

        return response()->json([
            "message" => "Termos de Serviço criado com sucesso!"
        ], 201);
    }

    public function updateUserTerms(Request $request, $id)
    {
        if (UserTerms::where('id', $id)->exists()) {
            $reserva = UserTerms::find($id);
            $reserva->descricao = is_null($request->descricao) ? $reserva->descricao : $request->descricao;
            $reserva->situacao = is_null($request->situacao) ? $reserva->situacao : $request->situacao;
            $reserva->save();

            return response()->json([
                "message" => "Termos de Serviço atualizado com sucesso!"
            ], 200);
        } else {
            return response()->json([
                "error" => "Erro ao atualizar o Termo de Serviço."
            ], 400);
        }
    }

    public function getUserTerms()
    {
        if (UserTerms::where('situacao', 'A')->exists()) {
            $termos = UserTerms::where('situacao', 'A')->get()->toJson(JSON_PRETTY_PRINT);
            return response($termos, 200);
        } else {
            return response()->json([
                "error" => "Termos de Serviço não encontrado!"
            ], 404);
        }
    }

    public function deleteUserTerms($id)
  { {
      if (UserTerms::where('id', $id)->exists()) {
        $termos = UserTerms::find($id);
        $termos->delete();

        return response()->json([
          "message" => "Termos de Serviço deletado!"
        ], 202);
      } else {
        return response()->json([
          "error" => "Termos de Serviço não encontrado!"
        ], 404);
      }
    }
  }
}
