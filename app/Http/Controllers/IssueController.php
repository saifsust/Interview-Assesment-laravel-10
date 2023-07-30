<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\BookMeta;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Utility;

class IssueController extends Controller
{

    public function issued(Request $request)
    {
        Utility::isAuthenticated($request);
        if ($request->accepts(['application/json'])) {

            if (Utility::isAuthenticated($request)) {
                Log::info($request->all());
                $data = $request->all();
                $issued_at = Carbon::now()->toDateTimeString();
                $issued_book = array(
                    "user_id" => $data['user_id'],
                    "book_id" => $data['book_id'],
                    "issued_at" => $issued_at,
                );
                $bookMeta = BookMeta::create($issued_book);
                return response()->json($bookMeta, 201)
                    ->header('Content-Type', "application/json");
            }

            return response()->json(null, 401)
                ->header('Content-Type', "application/json");
        }
        return response()->json(403)
            ->header('Content-Type', "application/json");
    }

    public function returned(Request $request)
    {
        Utility::isAuthenticated($request);
        if ($request->accepts(['application/json'])) {

            if (Utility::isAuthenticated($request)) {
                Log::info($request->all());
                $data = $request->all();
                $bookMeta = BookMeta::orderBy('issued_at', 'desc')->limit(1)->get()[0];
                Log::info($bookMeta);
                $returned_at = Carbon::now()->toDateTimeString();
                $data = array(
                    "user_id" => $bookMeta['user_id'],
                    "book_id" => $bookMeta['book_id'],
                    "is_returned" => true,
                    "issued_at" => $bookMeta['issued_at'],
                    "returned_at" => $returned_at
                );

                return response()->json(BookMeta::where('id', $bookMeta['id'])->update($data), 201)
                    ->header('Content-Type', "application/json");
            }

            return response()->json(null, 401)
                ->header('Content-Type', "application/json");
        }
        return response()->json(403)
            ->header('Content-Type', "application/json");
    }



    public function getUserByBookId(Request $request, string $bookId)
    {
        if (Utility::isAuthenticated($request)) {
            Log::info($request->all());
            $users = DB::select("SELECT DISTINCT users.email, users.id, users.name FROM users JOIN book_metas ON users.id = book_metas.user_id WHERE book_metas.book_id =" . $bookId);
            Log::info($users);
            return response()->json($users, 200)
                ->header('Content-Type', "application/json");
        }

        return response()->json(null, 401)
            ->header('Content-Type', "application/json");
    }

    public function getBookByUserId(Request $request, string $userId)
    {
        if (Utility::isAuthenticated($request)) {
            Log::info($request->all());
            $books = DB::select("SELECT DISTINCT books.name, books.id, books.author_name FROM books JOIN book_metas ON books.id = book_metas.book_id WHERE book_metas.user_id =" . $userId);
            Log::info($books);
            return response()->json($books, 200)
                ->header('Content-Type', "application/json");
        }
        return response()->json(null, 401)
            ->header('Content-Type', "application/json");
    }

}