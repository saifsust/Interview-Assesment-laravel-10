<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Models\User;



class Utility
{


    public static function isAuthenticated(Request $request)
    {
        $authorization = $request->header('authorization');

        if ($authorization == null)
            return false;

        $data = preg_split("/[:]+/", base64_decode($authorization));

        if ($data == null) {
            return false;
        }

        $user = User::where("email", $data[0])->get()[0];
        $password = Crypt::decryptString($user['password']);
        return $password == $data[1] && $user['email'] == $data[0] && $user['id'] == $data[2];
    }

}
