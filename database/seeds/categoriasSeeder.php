<?php

use Illuminate\Database\Seeder;

class categoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorias')->insert([
            "descripcion"=>"Ciencia ficcion"
        ]);

        DB::table('categorias')->insert([
            "descripcion"=>"Historia"
        ]);

        DB::table('categorias')->insert([
            "descripcion"=>"Medicina"
        ]);

        DB::table('categorias')->insert([
            "descripcion"=>"Epicos"
        ]);

        DB::table('categorias')->insert([
            "descripcion"=>"Literatura"
        ]);
    }
}
