<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;

class UserRestController extends Controller
{
  public function getUsers()
  {
    return response()->json(User::all(), 200)
      ->header('Content-Type', "application/json");
  }


  public function insert(Request $request)
  {
    if ($request->accepts(['application/json'])) {
      $data = $request->all();
      $array = array(
        "name" => $data['name'],
        "email" => $data['email'],
        "password" => Crypt::encryptString($data['password'])
      );
      $user = User::create($array);
      return response()->json($user, 201)
        ->header('Content-Type', "application/json");
    }
    return response()->json(403)
      ->header('Content-Type', "application/json");
  }

  public function login(Request $request)
  {
    if ($request->accepts(['application/json'])) {
      $data = $request->all();
      $user = User::where("email", $data['email'])->get()[0];
      $password = Crypt::decryptString($user['password']);
      if ($password === $data['password']) {
        $token = base64_encode($user['email'] . '.' . $data['password'] . ':' . $user['id']);
        return response()->json($token, 200)
          ->header('Content-Type', "application/json");
      }
      return response()->json($data, 200)
        ->header('Content-Type', "application/json");

    }
    return response()->json(401)
      ->header('Content-Type', "application/json");
  }

}