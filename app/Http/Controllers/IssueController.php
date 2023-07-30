<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\BookMeta;
use Illuminate\Support\Facades\Log;

class IssueController extends Controller
{

   public function issued(Request $request){
                if($request->accepts(['application/json'])){
                    Log::info($request->all());
                     $data = $request->all();
                     $issued_at = Carbon::now()->toDateTimeString();
                     $issued_book = array(
                       "user_id" => $data['user_id'],
                       "book_id" => $data['book_id'],
                       "issued_at"=> $issued_at,
                     );
                     $bookMeta = BookMeta::create($issued_book);
                    return response()->json($bookMeta, 201)
                                      ->header('Content-Type', "application/json");
                }
                return response()->json(403)
                                 ->header('Content-Type', "application/json");
             }

}
