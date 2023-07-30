<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Models\User;


class Utility
{
    public function __construct()
    {
    }

    public static function isAuthenticated(Request $request)
    {
        $data = $request->header('authorization');
        $user = User::where("email", $data['email'])->get()[0];
        $password = Crypt::decryptString($user['password']);
        if ($password === $data['password']) {
            return base64_encode($user['email'] . '.' . $data['password'] . ':'.$user['id']);
        }
        return response()->json(401)
            ->header('Content-Type', "application/json");
    }
}
