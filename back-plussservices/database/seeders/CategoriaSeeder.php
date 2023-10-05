<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


$datos = [
            array(
                'nombre' =>  "Tecnologia",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
array(
                'nombre' =>  "Metematicas",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
array(
                'nombre' =>  "Literatura",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
array(
                'nombre' =>  "Ciencia",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
        ];

        DB::table('categorias')->insert($datos);
    }
}



