<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Novidades;
use App\Models\User;
use App\Models\Clients;
use App\Models\Affiliated;
use App\Models\Environment;
use App\Models\LinkUser;
use App\Models\Relationship;
use App\Models\Reservations;

class ApiController extends Controller
{
  #############################################################
  #                                                           #
  #                                                           #
  #                         USUÁRIOS                          #
  #                                                           #
  #                                                           #
  #                                                           #
  #############################################################

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
        "error" => "Usuário não encontrado!"
      ], 404);
    }
  }

  public function getAllUsers()
  {
    $usuarios = User::get()->toJson(JSON_PRETTY_PRINT);
    return response($usuarios, 200);
  }

  public function updateUser(Request $request, $id)
  {
    if (User::where('id', $id)->exists()) {
      $usuarios = User::find($id);
      $usuarios->name = is_null($request->name) ? $usuarios->name : $request->name;
      $usuarios->email = is_null($request->email) ? $usuarios->email : $request->email;
      $usuarios->user_type = is_null($request->user_type) ? $usuarios->user_type : $request->user_type;
      $usuarios->cpf = is_null($request->cpf) ? $usuarios->cpf : $request->cpf;
      $usuarios->status = is_null($request->status) ? $usuarios->status : $request->status;
      $usuarios->save();

      return response()->json([
        "message" => "Usuário atualizado com sucesso!"
      ], 200);
    } else {
      return response()->json([
        "error" => "Erro ao atualizar."
      ], 404);
    }
  }

  public function deleteUser($id)
  { {
      if (User::where('id', $id)->exists()) {
        $usuarios = User::find($id);
        $usuarios->delete();

        return response()->json([
          "message" => "Usuário deletado!"
        ], 202);
      } else {
        return response()->json([
          "error" => "Usuário não encontrado!"
        ], 404);
      }
    }
  }

  #############################################################
  #                                                           #
  #                                                           #
  #                         CLIENTES                          #
  #                                                           #
  #                                                           #
  #                                                           #
  #############################################################

  public function createClient(Request $request)
  {
    $cliente = new Clients;
    $cliente->name = $request->name;
    $cliente->status = $request->status;
    $cliente->save();

    return response()->json([
      "message" => "Cliente cadastrado com sucesso."
    ], 201);
  }

  public function getClient($id)
  {
    if (Clients::where('id', $id)->exists()) {
      $cliente = Clients::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
      return response($cliente, 200);
    } else {
      return response()->json([
        "error" => "Cliente não encontrado!"
      ], 404);
    }
  }

  public function getAllClients()
  {
    $cliente = Clients::get()->toJson(JSON_PRETTY_PRINT);
    return response($cliente, 200);
  }

  public function updateClient(Request $request, $id)
  {
    if (Clients::where('id', $id)->exists()) {
      $cliente = Clients::find($id);
      $cliente->name = is_null($request->name) ? $cliente->name : $request->name;
      $cliente->status = is_null($request->status) ? $cliente->status : $request->status;
      $cliente->save();

      return response()->json([
        "message" => "Cliente atualizado com sucesso!"
      ], 200);
    } else {
      return response()->json([
        "error" => "Erro ao atualizar o cliente."
      ], 404);
    }
  }

  public function deleteClient($id)
  { {
      if (Clients::where('id', $id)->exists()) {
        $cliente = Clients::find($id);
        $cliente->delete();

        return response()->json([
          "message" => "Cliente deletado!"
        ], 202);
      } else {
        return response()->json([
          "error" => "Cliente não encontrado!"
        ], 404);
      }
    }
  }

  #############################################################
  #                                                           #
  #                                                           #
  #                       RELACIONAMENTO                      #
  #                                                           #
  #                                                           #
  #                                                           #
  #############################################################

  public function createRelationship(Request $request)
  {
    $relacionamento = new Relationship();
    $relacionamento->client = $request->client;
    $relacionamento->user = $request->user;
    $relacionamento->user_emp = $request->user_emp;
    $relacionamento->status = is_null($request->status) ? 'A' : $request->status;
    $relacionamento->save();

    return response()->json([
      "message" => "Relacionamento feito com sucesso."
    ], 201);
  }

  public function getRelationship($id)
  {
    if (Relationship::where('id', $id)->exists()) {
      $relacionamento = Relationship::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
      return response($relacionamento, 200);
    } else {
      return response()->json([
        "error" => "Relacionamento não encontrado!"
      ], 404);
    }
  }

  public function getRelationshipUser($user)
  {
    if (Relationship::where('user', $user)->exists()) {
      $relacionamento = Relationship::where('user', $user)->get()->toJson(JSON_PRETTY_PRINT);
      return response($relacionamento, 200);
    } else {
      return response()->json([
        "error" => "Relacionamento não encontrado!"
      ], 404);
    }
  }

  public function getAllRelationship()
  {
    $relacionamento = Relationship::get()->toJson(JSON_PRETTY_PRINT);
    return response($relacionamento, 200);
  }

  public function updateRelationship(Request $request, $id)
  {
    if (Relationship::where('id', $id)->exists()) {
      $relacionamento = Relationship::find($id);
      $relacionamento->client = is_null($request->client) ? $relacionamento->client : $request->client;
      $relacionamento->user = is_null($request->user) ? $relacionamento->user : $request->user;
      $relacionamento->user_emp = is_null($request->user_emp) ? $relacionamento->user_emp : $request->user_emp;
      $relacionamento->status = is_null($request->status) ? $relacionamento->status : $request->status;
      $relacionamento->save();

      return response()->json([
        "message" => "Relacionamento atualizado com sucesso!"
      ], 200);
    } else {
      return response()->json([
        "error" => "Erro ao atualizar o relacionamento."
      ], 404);
    }
  }

  public function deleteRelationship($id)
  { {
      if (Relationship::where('id', $id)->exists()) {
        $relacionamento = Relationship::find($id);
        $relacionamento->delete();

        return response()->json([
          "message" => "Relacionamento deletado!"
        ], 202);
      } else {
        return response()->json([
          "error" => "Relacionamento não encontrado!"
        ], 404);
      }
    }
  }

  #############################################################
  #                                                           #
  #                                                           #
  #                       CONVENIADAS                         #
  #                                                           #
  #                                                           #
  #                                                           #
  #############################################################

  public function createAffiliated(Request $request)
  {
    $conveniadas = new Affiliated();
    $conveniadas->client = $request->client;
    $conveniadas->idaffiliated = $request->idaffiliated;
    $conveniadas->name = $request->name;
    $conveniadas->status = is_null($request->status) ? 'A' : $request->status;
    $conveniadas->save();

    return response()->json([
      "message" => "Conveniada criada com sucesso!"
    ], 201);
  }

  public function getAffiliated($id)
  {
    if (Affiliated::where('id', $id)->exists()) {
      $conveniadas = Affiliated::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
      return response($conveniadas, 200);
    } else {
      return response()->json([
        "error" => "Conveniada não encontrada!"
      ], 404);
    }
  }

  public function getAllAffiliated()
  {
    $conveniadas = Affiliated::get()->toJson(JSON_PRETTY_PRINT);
    return response($conveniadas, 200);
  }

  public function updateAffiliated(Request $request, $id)
  {
    if (Affiliated::where('id', $id)->exists()) {
      $conveniadas = Affiliated::find($id);
      $conveniadas->client = is_null($request->client) ? $conveniadas->client : $request->client;
      $conveniadas->idaffiliated = is_null($request->idaffiliated) ? $conveniadas->idaffiliated : $request->idaffiliated;
      $conveniadas->name = is_null($request->name) ? $conveniadas->name : $request->name;
      $conveniadas->status = is_null($request->status) ? $conveniadas->status : $request->status;
      $conveniadas->save();

      return response()->json([
        "message" => "Conveniada atualizada com sucesso!"
      ], 200);
    } else {
      return response()->json([
        "error" => "Erro ao atualizar a Conveniada."
      ], 404);
    }
  }

  public function deleteAffiliated($id)
  { {
      if (Affiliated::where('id', $id)->exists()) {
        $conveniadas = Affiliated::find($id);
        $conveniadas->delete();

        return response()->json([
          "message" => "Convieniada deletada!"
        ], 202);
      } else {
        return response()->json([
          "error" => "Conveniada não encontrada!"
        ], 404);
      }
    }
  }

  #############################################################
  #                                                           #
  #                                                           #
  #                       Ambiente                            #
  #                                                           #
  #                                                           #
  #                                                           #
  #############################################################

  public function createEnvironment(Request $request)
  {
    $ambiente = new Environment();
    $ambiente->client = $request->client;
    $ambiente->name = $request->name;
    $ambiente->status = is_null($request->status) ? 'A' : $request->status;
    $ambiente->save();

    return response()->json([
      "message" => "Ambiente criado com sucesso!"
    ], 201);
  }

  public function getEnvironment($id)
  {
    if (Environment::where('id', $id)->exists()) {
      $ambiente = Environment::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
      return response($ambiente, 200);
    } else {
      return response()->json([
        "error" => "Ambiente não encontrado!"
      ], 404);
    }
  }

  public function getEnvironmentClient($client)
  {
    if (Environment::where('client', $client)->exists()) {
      $ambiente = Environment::where('client', $client)->get()->toJson(JSON_PRETTY_PRINT);
      return response($ambiente, 200);
    } else {
      return response()->json([
        "error" => "Ambiente não encontrado!"
      ], 404);
    }
  }

  public function getAllEnvironments()
  {
    $ambiente = Environment::get()->toJson(JSON_PRETTY_PRINT);
    return response($ambiente, 200);
  }

  public function updateEnvironment(Request $request, $id)
  {
    if (Environment::where('id', $id)->exists()) {
      $ambiente = Environment::find($id);
      $ambiente->client = is_null($request->client) ? $ambiente->client : $request->client;
      $ambiente->name = is_null($request->name) ? $ambiente->name : $request->name;
      $ambiente->status = is_null($request->status) ? $ambiente->status : $request->status;
      $ambiente->save();

      return response()->json([
        "message" => "Ambiente atualizado com sucesso!"
      ], 200);
    } else {
      return response()->json([
        "error" => "Erro ao atualizar o ambiente."
      ], 404);
    }
  }

  public function deleteEnvironment($id)
  { {
      if (Environment::where('id', $id)->exists()) {
        $ambiente = Environment::find($id);
        $ambiente->delete();

        return response()->json([
          "message" => "Ambiente deletado!"
        ], 202);
      } else {
        return response()->json([
          "error" => "Ambiente não encontrado!"
        ], 404);
      }
    }
  }


  #############################################################
  #                                                           #
  #                                                           #
  #                Ligação Usuário x CLiente                  #
  #                                                           #
  #                                                           #
  #                                                           #
  #############################################################

  public function createLinkUser(Request $request)
  {
    $ligacao = new LinkUser();
    $ligacao->client = $request->client;
    $ligacao->name = $request->name;
    $ligacao->email = $request->email;
    $ligacao->status = is_null($request->status) ? 'A' : $request->status;
    $ligacao->save();

    return response()->json([
      "message" => "Ligação feita com sucesso!"
    ], 201);
  }

  public function getLinkUser($id)
  {
    if (LinkUser::where('id', $id)->exists()) {
      $ligacao = LinkUser::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
      return response($ligacao, 200);
    } else {
      return response()->json([
        "error" => "Ligação não encontrada!"
      ], 404);
    }
  }

  public function getLinkUserClient($client)
  {
    if (LinkUser::where('id', $client)->exists()) {
      $ligacao = LinkUser::where('id', $client)->get()->toJson(JSON_PRETTY_PRINT);
      return response($ligacao, 200);
    } else {
      return response()->json([
        "error" => "Ligação não encontrada!"
      ], 404);
    }
  }

  public function getAllLinkUser()
  {
    $ligacao = LinkUser::get()->toJson(JSON_PRETTY_PRINT);
    return response($ligacao, 200);
  }

  public function updateLinkUser(Request $request, $id)
  {
    if (LinkUser::where('id', $id)->exists()) {
      $ligacao = LinkUser::find($id);
      $ligacao->client = is_null($request->client) ? $ligacao->client : $request->client;
      $ligacao->name = is_null($request->name) ? $ligacao->name : $request->name;
      $ligacao->email = is_null($request->email) ? $ligacao->email : $request->email;
      $ligacao->status = is_null($request->status) ? $ligacao->status : $request->status;
      $ligacao->save();

      return response()->json([
        "message" => "Ligação atualizada com sucesso!"
      ], 200);
    } else {
      return response()->json([
        "error" => "Erro ao atualizar a ligação."
      ], 404);
    }
  }

  public function deleteLinkUser($id)
  { {
      if (LinkUser::where('id', $id)->exists()) {
        $ligacao = LinkUser::find($id);
        $ligacao->delete();

        return response()->json([
          "message" => "Ligação deletada!"
        ], 202);
      } else {
        return response()->json([
          "error" => "Ligação não encontrada!"
        ], 404);
      }
    }
  }

  #############################################################
  #                                                           #
  #                                                           #
  #                        Reservas                           #
  #                                                           #
  #                                                           #
  #                                                           #
  #############################################################

  public function createReservation(Request $request)
  {
    $reserva = new Reservations();
    $reserva->user = $request->user;
    $reserva->client = $request->client;
    $reserva->title = $request->title;
    $reserva->desc = $request->desc;
    $reserva->idenvironment = $request->idenvironment;
    $reserva->reserved_at = $request->reserved_at;
    $reserva->reserved_until = $request->reserved_until;
    $reserva->status = is_null($request->status) ? 'A' : $request->status;
    $reserva->save();

    return response()->json([
      "message" => "Reserva feita com sucesso!"
    ], 201);
  }

  public function getReservation($id)
  {
    if (Reservations::where('id', $id)->exists()) {
      $reserva = Reservations::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
      return response($reserva, 200);
    } else {
      return response()->json([
        "error" => "Reserva não encontrada!"
      ], 404);
    }
  }

  public function getClientReservation($client)
  {
    if (Reservations::where('client', $client)->exists()) {
      $reserva = Reservations::where('client', $client)->get()->toJson(JSON_PRETTY_PRINT);
      return response($reserva, 200);
    } else {
      return response()->json([
        "error" => "Reserva não encontrada!"
      ], 404);
    }
  }

  public function getUserReservation($user)
  {
    if (Reservations::where('id', $user)->exists()) {
      $reserva = Reservations::where('id', $user)->get()->toJson(JSON_PRETTY_PRINT);
      return response($reserva, 200);
    } else {
      return response()->json([
        "error" => "Reserva não encontrada!"
      ], 404);
    }
  }

  public function getEnvironmentReservation($idenvironment)
  {
    if (Reservations::where('idenvironment', $idenvironment)->exists()) {
      $reserva = Reservations::where('idenvironment', $idenvironment)->get()->toJson(JSON_PRETTY_PRINT);
      return response($reserva, 200);
    } else {
      return response()->json([
        "error" => "Reserva não encontrada!"
      ], 404);
    }
  }

  public function getAllReservations()
  {
    $reserva = Reservations::get()->toJson(JSON_PRETTY_PRINT);
    return response($reserva, 200);
  }

  public function updateReservation(Request $request, $id)
  {
    if (Reservations::where('id', $id)->exists()) {
      $reserva = Reservations::find($id);
      $reserva->user = is_null($request->user) ? $reserva->user : $request->user;
      $reserva->client = is_null($request->client) ? $reserva->client : $request->client;
      $reserva->title = is_null($request->title) ? $reserva->title : $request->title;
      $reserva->desc = is_null($request->desc) ? $reserva->desc : $request->desc;
      $reserva->idenvironment = is_null($request->idenvironment) ? $reserva->idenvironment : $request->idenvironment;
      $reserva->reserved_at = is_null($request->reserved_at) ? $reserva->reserved_at : $request->reserved_at;
      $reserva->reserved_until = is_null($request->reserved_until) ? $reserva->reserved_until : $request->reserved_until;
      $reserva->status = is_null($request->status) ? $reserva->status : $request->status;
      $reserva->save();

      return response()->json([
        "message" => "Reserva atualizada com sucesso!"
      ], 200);
    } else {
      return response()->json([
        "error" => "Erro ao atualizar a reserva."
      ], 404);
    }
  }

  public function deleteReservation($id)
  { {
      if (Reservations::where('id', $id)->exists()) {
        $reserva = Reservations::find($id);
        $reserva->delete();

        return response()->json([
          "message" => "Reserva deletada!"
        ], 202);
      } else {
        return response()->json([
          "error" => "Reserva não encontrada!"
        ], 404);
      }
    }
  }
}
