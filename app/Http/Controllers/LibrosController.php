<?php

namespace App\Http\Controllers;
use App\Libro;
use App\Categorias;
use Auth;
use Illuminate\Http\Request;

class LibrosController extends Controller
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
        $libros = new Libro();
        $listaLibros = $libros->select('libros.*','c.descripcion','u.name','u.id as idusuario')
                                  ->join('categorias as c','libros.categorias_fk','c.id')
                                  ->join('users as u','libros.users_fk','u.id')
                                  ->orderBy('libros.id','desc')
                                  ->get();
        return view('libros.libros',["libros"=>$listaLibros]);
    }

    public function crear(){
        $categorias = Categorias::All();
        return view('libros.crear',["categorias"=>$categorias]);
    }

    public function guardar(Request $request){
        $rules = ["nombre"=>"required|min:5",
                  "paginas"=>"required|numeric|min:50",
                  "categoria"=>"required|numeric|min:1",
                  "isbn"=>"required|numeric|digits:13|unique:libros,isbn"];


        $mensaje = ["nombre.required"=>"Nombre es requerido",
                    "nombre.min"=>"Nombre del libro debe contener minimo 5 caracteres",
                    "paginas.required"=>"paginas es requerido",
                    "paginas.numeric"=>"pagina solo admite valores numericos",
                    "paginas.min"=>"El libro debe tener minimo 50 paginas",
                    "categoria.required"=>"categoria es requerido",
                    "categoria.numeric"=>"categoria debe ser numerico",
                    "categoria.min"=>"Debe seleccionar alguna categoria",
                    "isbn.required"=>"Codigo isbn es requerido",
                    "isbn.numeric"=>"Codigo isbn debe ser numerico",
                    "isbn.digits"=>"Codigo isbn debe contener 13 caracteres",
                    "isbn.unique"=>"Codigo isbn ya esta registrado en la bd"];
        $validator = \Validator::make($request->all(), $rules, $mensaje);
        if($validator->fails()){
            return \Redirect::back()->withErrors($validator)->withInput();
        }
        $auth = Auth::user();
        $libros = new Libro();
        $libros->nombre = $request->nombre;
        $libros->paginas = $request->paginas;
        $libros->categorias_fk =$request->categoria;
        $libros->users_fk = $auth->id;
        $libros->isbn = $request->isbn;
        $libros->save();
        if($libros){
        
            return \Redirect::to('/libros')->with('mensaje','Libros creado correctamente');
       
        }
        return \Redirect::to('/libros')->with('mensaje','Libro no se pudo registrar');

    }

    public function edit($id){
        $libro = Libro::findOrFail($id);
        $categorias = Categorias::All();
        return view("libros.editar",["libro"=>$libro,"categorias"=>$categorias]);
    }

    public function update(Request $request){
        $rules = ["nombre"=>"required|min:5",
                  "paginas"=>"required|numeric|min:50",
                  "categoria"=>"required|numeric|min:1",
                  "isbn"=>"required|numeric|digits:13|unique:libros,isbn,".$request->id];


        $mensaje = ["nombre.required"=>"Nombre es requerido",
                    "nombre.min"=>"Nombre del libro debe contener minimo 5 caracteres",
                    "paginas.required"=>"paginas es requerido",
                    "paginas.numeric"=>"pagina solo admite valores numericos",
                    "paginas.min"=>"El libro debe tener minimo 50 paginas",
                    "categoria.required"=>"categoria es requerido",
                    "categoria.numeric"=>"categoria debe ser numerico",
                    "categoria.min"=>"Debe seleccionar alguna categoria",
                    "isbn.required"=>"Codigo isbn es requerido",
                    "isbn.numeric"=>"Codigo isbn debe ser numerico",
                    "isbn.digits"=>"Codigo isbn debe contener 13 caracteres",
                    "isbn.unique"=>"Codigo isbn ya esta registrado en la bd"];
        $validator = \Validator::make($request->all(), $rules, $mensaje);
            if($validator->fails()) {
                    return \Redirect::back()->withErrors($validator)->withInput();
                }
        $libro = Libro::find($request->id);
        $libro->nombre = $request->nombre;
        $libro->paginas = $request->paginas;
        $libro->categorias_fk = $request->categoria;
        $libro->isbn = $request->isbn;
        $libro->update();
        if($libro){
            return \Redirect::to('/libros')->with('mensaje','Libro editado correctamente');
        }
        return \Redirect::to('/libros')->with('mensaje','No se pudo editar');

        
    }

    public function eliminar($id){
        $libro = Libro::findOrFail($id);
        if($libro){
            $libro->delete();
        }
        return \Redirect::to('/libros')->with('mensaje','Eliminado correctamente');
    }

   

}
