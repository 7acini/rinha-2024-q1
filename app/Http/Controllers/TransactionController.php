<?php

namespace App\Http\Controllers;

use App\Models\Client;
use DB;
use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function store(Request $request, $id){

        $data = $request->validate([
            "value"=> "required|integer",
            "type"=> "required|in:c,d",
            "description"=> "required|string|max:10",
        ]);

        return DB::transaction(function () use ($id, $data){

            $client = Client::find($id);

            if(!$client){
                return response()->json(['error' => 'Client not found'],404);
            }

            if($data['type'] === 'd' && $client->balance + $client->limit < $data['value']){
                return response()->json(['error'=> 'Insufficient Balance'],422);
            }

            if($data['type'] === 'c'){
                $client->balance += $data['value'];
            } else{
                $client->balance -= $data['value'];
            }

            $client->save();

            $trasaction = Transaction::create([
                'client_id'=> $client->id,
                'value' => $data['value'],
                'type'=> $data['type'],
                'description'=> $data['description'],
            ]);
            return response()->json([
                'limit'=> $client->limit,
                'balance' => $client->balance,
            ],200);
        });
    }
}
