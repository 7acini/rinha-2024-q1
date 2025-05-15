<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
class ExtractController extends Controller
{
    public function show($id){

        $client = Client::with(['transaction' => function ($q) {
            $q->orderBy('created_at','desc')->limit(10);
        }])->find($id);

        if(!$client){
            return response()->json(['error' => 'Client not found'],404);
        }

        return response()->json([
            'balance' => [
                'total'=> $client->balance,
                'limit'=> $client->limit,
                'extract_date' => now()->toIso8601String(),
                ],
                'last_transaction' => $client->transaction
        ]);
    }
}
