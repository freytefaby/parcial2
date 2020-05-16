<?php

use Illuminate\Database\Seeder;

class libroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('libros')->insert([
            "nombre"=>"Harry poter y la piedra filosofal",
            "paginas"=>55,
            "categorias_fk"=> 1,
            "users_fk"=>1,
            "isbn"=>454515
        ]);
    }
}
