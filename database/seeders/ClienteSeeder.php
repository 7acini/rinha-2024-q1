<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('clientes')->insert([
            ['id' => 1, 'nome' => 'Cliente 1', 'limite' => 100000, 'saldo' => 0],
            ['id' => 2, 'nome' => 'Cliente 2', 'limite' => 80000, 'saldo' => 0],
            ['id' => 3, 'nome' => 'Cliente 3', 'limite' => 1000000, 'saldo' => 0],
            ['id' => 4, 'nome' => 'Cliente 4', 'limite' => 10000000, 'saldo' => 0],
            ['id' => 5, 'nome' => 'Cliente 5', 'limite' => 500000, 'saldo' => 0],
        ]);
    }
}
