
@extends('layouts.layaut')

@section('content')
@if(Session::has('mensaje'))                 
<div class="alert alert-success" role="alert">
  <h4 class="alert-heading">Informacion:</h4>
  <p class="mb-0">{{Session::get('mensaje')}}</p>
</div>
@endif	
<h1>Usuarios</h1>
<a href="usuarios/crear"><button class="btn btn-primary btn-sm"> Crear Usuario</button></a><br><br>
@if(count($usuarios)>0)
<table class="table"> 

    <thead>
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Cedula</th>
            <th>Rol</th>
            <th>Email</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($usuarios as $usu)
        <tr>
            <td>{{$usu->id}}</td>
            <td>{{$usu->name}}</td>
            <td>{{$usu->username}}</td>
            <td>{{$usu->descripcion}}</td>
            <td>{{$usu->email}}</td>
            <td><a href="/usuarios/edit/{{$usu->id}}" class="btn btn-primary btn-sm">Editar</a>
                <a href="/usuarios/delete/{{$usu->id}}" class="btn btn-danger btn-sm">Eliminar</a>
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