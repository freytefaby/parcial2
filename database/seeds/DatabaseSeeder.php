<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
   
    public function run()
    {
        $this->truncateTables([
            'rol',
            'users',
            'libros',
            'categorias'
        ]);
         $this->call(rolSeeder::class);
         $this->call(usuarioSeeder::class);
         $this->call(categoriasSeeder::class);
         $this->call(libroSeeder::class);
    }

    protected function  truncateTables(array $tables){
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        foreach($tables as $table){
            DB::table($table)->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
