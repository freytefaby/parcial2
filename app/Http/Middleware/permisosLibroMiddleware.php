<?php
namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use App\Libro;
use Illuminate\Support\Facades\Route;
use Closure;

class permisosLibroMiddleware{
    public function handle($request, Closure $next){
        $data=Route::current()->parameters();
        $auth = Auth::user();
        $libro = Libro::findOrFail($data["id"]);
        if($libro){
            if($libro->users_fk == $auth->id){
                return $next($request);
            }

            return \Redirect::to('/libros')->with('mensaje','El libro no te pertenece');
        }

        return \Redirect::to('/libros')->with('mensaje','El libro no existe');
        
       
            
        
    }

}