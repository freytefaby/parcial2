<?php

use Illuminate\Database\Seeder;

class usuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            "name"=>"Pruebas",
            "username"=>"1140830054",
            "email"=>"ffreytte@gmail.com",
            "password"=>bcrypt("12345678"),
            "rol_fk"=>1

        ]);
    }
}
