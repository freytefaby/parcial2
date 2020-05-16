
@extends('layouts.layaut')

@section('content')
@if(Session::has('mensaje'))                 
<div class="alert alert-success" role="alert">
  <h4 class="alert-heading">Informacion:</h4>
  <p class="mb-0">{{Session::get('mensaje')}}</p>
</div>
@endif	
<h1>Libros</h1>
<a href="libros/crear"><button class="btn btn-primary btn-sm"> Crear Libro</button></a><br><br>
@if(count($libros)>0)
<table class="table"> 

    <thead>
        <tr>
            <th>codigo</th>
            <th>Nombre</th>
            <th>paginas</th>
            <th>Categoria</th>
            <th>Usuario</th>
            <th>ISBN</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($libros as $lib)
        <tr>
            <td>{{$lib->id}}</td>
            <td>{{$lib->nombre}}</td>
            <td>{{$lib->paginas}}</td>
            <td>{{$lib->descripcion}}</td>
            <td>{{$lib->name}}</td>
            <td>{{$lib->isbn}}</td>
            <td>
                @if(Auth::user()->rol_fk == 1 || $lib->idusuario == Auth::user()->id)
                <a href="/libros/edit/{{$lib->id}}" class="btn btn-primary btn-sm">Editar</a>
                <a href="/libros/delete/{{$lib->id}}" class="btn btn-danger btn-sm">Eliminar</a>
                @else
                    No puedes editar estos libros
                @endif
            </td> 
        
        </tr>
    @endforeach
    </tbody>

</table>

@else
<div class="alert alert-danger" role="alert">
  <h4 class="alert-heading">No hay usuarios</h4>
  <p class="mb-0">No hay usuarios, puedes crear un usuario aqui ;)</p>
</div>

@endif
@endsection