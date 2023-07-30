<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Books;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Utility;

class BookRestController extends Controller
{

    public function getBooks(Request $request)
    {

        if (Utility::isAuthenticated($request)) {
            return response()->json(Books::all(), 200)
                ->header('Content-Type', "application/json");
        }

        return response()->json(null, 401)
            ->header('Content-Type', "application/json");
    }


    public function insert(Request $request)
    {
        if ($request->accepts(['application/json'])) {

            if (Utility::isAuthenticated($request)) {
                Log::info($request->all());
                $books = Books::create($request->all());
                return response()->json($books, 201)
                    ->header('Content-Type', "application/json");
            }


            return response()->json(null, 401)
                ->header('Content-Type', "application/json");

        }
        return response()->json(403)
            ->header('Content-Type', "application/json");
    }

}