<?php

use Illuminate\Database\Seeder;

class rolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rol')->insert([
            "descripcion"=>"Administrador"
        ]);

        DB::table('rol')->insert([
            "descripcion"=>"Usuarios"
        ]);
    }
}
