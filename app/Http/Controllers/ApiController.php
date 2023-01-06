<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Novidades;
use App\Models\User;

class ApiController extends Controller
{
  public function getAllNews()
  {
    $novidades = Novidades::get()->toJson(JSON_PRETTY_PRINT);
    return response($novidades, 200);
  }

  public function createNews(Request $request)
  {
    $novidades = new Novidades;
    $novidades->id = $request->id;
    $novidades->titulo = $request->titulo;
    $novidades->descricao = $request->descricao;
    $novidades->data = $request->data;
    $novidades->situacao = $request->situacao;
    $novidades->save();


    return response()->json([
      "message" => "Novidade gravada com sucesso!"
    ], 201);
  }

  public function createUser(Request $request)
  {
    $usuarios = new User;
    $usuarios->name = $request->name;
    $usuarios->email = $request->email;
    $usuarios->password = password_hash($request->password, null);    
    $usuarios->save();

    return response()->json([
      "message" => "Usuário cadastrado com sucesso."
    ], 201);
  }

  public function getUser($id)
  {
    if (User::where('id', $id)->exists()) {
      $usuarios = User::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
      return response($usuarios, 200);
    } else {
      return response()->json([
        "message" => "Usuário não encontrado!"
      ], 404);
    }
  }

  public function getAllUsers()
  {
    $usuarios = User::get()->toJson(JSON_PRETTY_PRINT);
    return response($usuarios, 200);
  }

  public function UpdateUser(Request $request, $id)
  {
    if (User::where('id', $id)->exists()) {
      $usuarios = User::find($id);
      $usuarios->name = is_null($request->name) ? $usuarios->name : $request->name;
      $usuarios->email = is_null($request->email) ? $usuarios->email : $request->email;
      $usuarios->user_type = is_null($request->user_type) ? $usuarios->user_type : $request->user_type;
      $usuarios->save();

      return response()->json([
        "message" => "Usuário atualizado com sucesso!"
      ], 200);
    } else {
      return response()->json([
        "message" => "Erro ao atualizar."
      ], 404);
    }
  }

  public function getNews($id)
  {
    if (Novidades::where('id', $id)->exists()) {
      $novidades = Novidades::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
      return response($novidades, 200);
    } else {
      return response()->json([
        "message" => "Novidade não encontrada!"
      ], 404);
    }
  }

  public function updateNews(Request $request, $id)
  {
    if (Novidades::where('id', $id)->exists()) {
      $novidades = Novidades::find($id);
      $novidades->titulo = is_null($request->titulo) ? $novidades->titulo : $request->titulo;
      $novidades->descricao = is_null($request->descricao) ? $novidades->descricao : $request->descricao;
      $novidades->save();

      return response()->json([
        "message" => "Novidade atualizada com sucesso!"
      ], 200);
    } else {
      return response()->json([
        "message" => "Novidade não encontrada!"
      ], 404);
    }
  }

  public function deleteNews($id)
  { {
      if (Novidades::where('id', $id)->exists()) {
        $novidades = Novidades::find($id);
        $novidades->delete();

        return response()->json([
          "message" => "Novidade deletada!"
        ], 202);
      } else {
        return response()->json([
          "message" => "Novidade não encontrada!"
        ], 404);
      }
    }
  }
}
