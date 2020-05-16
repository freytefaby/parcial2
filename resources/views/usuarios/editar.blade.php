@extends('layouts.layaut')
@section('content')

<div class="card">
  <div class="card-body">
  Editar usuarios<br><br>
  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif
  <form method="post" action="/usuarios/update">
  <div class="form-group">
    <label for="exampleInputEmail1">Nombre</label>
    <input type="text" name="nombre" class="form-control"  placeholder="Nombre" value="{{$usuario->name}}">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Cedula</label>
    <input type="text" name="username" class="form-control"  placeholder="Cedula" value="{{$usuario->username}}">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Correo</label>
    <input type="text" name="email" class="form-control"  placeholder="Correo electronico" value="{{$usuario->email}}">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Contraseña</label>
    <input type="password" name="password" class="form-control"  placeholder="Password" value="{{old('password')}}">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Perfil</label>
    <select class="form-control" name="rol">
    @if($usuario->rol_fk == 1)
      <option value="1" selected>Administrador</option>
      <option value="2">usuario</option>
    @else
      <option value="1" >Administrador</option>
      <option value="2" selected>usuario</option>
    @endif
    </select>
  </div>
  

  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <input type="hidden" name="id" value="{{$usuario->id}}">
  <button type="submit" class="btn btn-primary">Editar</button>
  
</form>
   </div>
</div>

@endsection