<?php

namespace App\Http\Controllers;
use App\User;
use App\Libro;
use Auth;
use Illuminate\Http\Request;
use Mail;

class UsuariosController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('permisos',['only'=>['index','crear','store','edit']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $usuarios = new User();
        $auth = Auth::user();
        $listaUsuarios = $usuarios->select('users.*','r.descripcion')
                                  ->join('rol as r','users.rol_fk','r.id')
                                  ->whereNotIn('users.id',[$auth->id])
                                  ->orderBy('users.id','desc')
                                  ->get();
        return view('usuarios.usuarios',["usuarios"=>$listaUsuarios]);
    }

    public function crear(){
        return view('usuarios.crear');
    }

    public function guardar(Request $request){
        $rules = ["nombre"=>"required",
                  "username"=>"required|numeric|unique:users,username",
                  "password"=>"required|min:8",
                  "email"=>"required|email|unique:users,email",
                  "rol"=>"required|numeric|in:1,2"];
        $mensaje = ["nombre.required"=>"Nombre es requerido",
                    "username.required"=>"Cedula es requerido",
                    "username.numeric"=>" Cedula solo admite valores numericos",
                    "username.unique"=>"este numero de cedula ya existe en nuestra bd",
                    "password.required"=>"Password es requerido",
                    "email.required"=>"Correo es requerido",
                    "email.email"=>"Correo es incorrecto",
                    "email.unique"=>"este correoe electronico ya existe en nuestra bd",
                    "rol.required"=>"perfil es requerido",
                    "rol.numeric"=>"perfil solo admite valores numericos",
                    "rol.in"=>"perfil solo admite valores del 1 al 2"];
        $validator = \Validator::make($request->all(), $rules, $mensaje);
        if($validator->fails()){
            return \Redirect::back()->withErrors($validator)->withInput();
        }
        $usuarios = new User();
        $usuarios->name = $request->nombre;
        $usuarios->username = $request->username;
        $usuarios->password = bcrypt($request->password);
        $usuarios->rol_fk = $request->rol;
        $usuarios->email = $request->email;
        $usuarios->save();
        if($usuarios){
            //envio de correos electronicos
        try{
            $encabezado = "Bienvenido Librerias Group";
            $user = Auth::user();
            $mail = $user->email;
            Mail::send('correo.send',["usuarios"=>$usuarios], function($msj) use($encabezado,$mail){
               $msj->subject($encabezado);
               $msj->to($mail);
            });
            return \Redirect::to('/usuarios')->with('mensaje','Usuario creado correctamente');
        }catch(\Swift_TransportException $e){
            $response = $e->getMessage();
            return \Redirect::to('/usuarios')->with('mensaje',$response);
        }
        }
        return \Redirect::to('/usuarios')->with('mensaje','Usuario no se pudo registrar');

    }

    public function edit($id){
        $user = User::findOrFail($id);
        return view("usuarios.editar",["usuario"=>$user]);
    }

    public function update(Request $request){
        $rules = ["nombre"=>"required",
                  "username"=>"required|numeric|unique:users,username,".$request->id,
                  "email"=>"required|email|unique:users,email,".$request->id,
                  "rol"=>"required|numeric|in:1,2"];
        $mensaje = ["nombre.required"=>"Nombre es requerido",
                    "username.required"=>"Cedula es requerido",
                    "username.numeric"=>" Cedula solo admite valores numericos",
                    "username.unique"=>"este numero de cedula ya existe en nuestra bd",
                    "email.required"=>"Correo es requerido",
                    "email.email"=>"Correo es incorrecto",
                    "email.unique"=>"este correoe electronico ya existe en nuestra bd",
                    "rol.required"=>"perfil es requerido",
                    "rol.numeric"=>"perfil solo admite valores numericos",
                    "rol.in"=>"perfil solo admite valores del 1 al 2"];
        $validator = \Validator::make($request->all(), $rules, $mensaje);
            if($validator->fails()) {
                    return \Redirect::back()->withErrors($validator)->withInput();
                }
        $user = User::find($request->id);
        $user->name = $request->nombre;
        $user->email = $request->email;
        $user->username = $request->username;
        if($request->password != null){
            $user->password = bcrypt($request->password);
        }
        $user->rol_fk = $request->rol;
        $user->update();
        if($user){
            return \Redirect::to('/usuarios')->with('mensaje','Usuario editado correctamente');
        }
        return \Redirect::to('/usuarios')->with('mensaje','No se pudo editar');

        
    }

    public function eliminar($id){
        $libro = Libro::where('users_fk',$id)->first();
        if(!$libro){
            $user = User::findOrFail($id);
            if($user){
                $user->delete();
            }
            return \Redirect::to('/usuarios')->with('mensaje','Eliminado correctamente');
        }
        return \Redirect::to('/usuarios')->with('mensaje','Este usuario no se puede eliminar porque tiene libros asociados');
        
    }

   

}
