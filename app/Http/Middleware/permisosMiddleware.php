<?php
namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use App\User;
use Closure;

class permisosMiddleware{
    public function handle($request, Closure $next){
        
        $auth = Auth::user();
        $user = User::find($auth->id);
        if($user->rol_fk == 1){
            return $next($request);
        }else{
            return \Redirect::to('/libros')->with('mensaje','No tienes permiso para este modulo');
        }
    }

}