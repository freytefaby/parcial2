@extends('layouts.layaut')
@section('content')

<div class="card">
  <div class="card-body">
  Crear usuarios<br><br>
  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif
  <form method="post" action="/usuarios/store">
  <div class="form-group">
    <label for="exampleInputEmail1">Nombre</label>
    <input type="text" name="nombre" class="form-control"  placeholder="Nombre" value="{{old('nombre')}}">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Cedula</label>
    <input type="text" name="username" class="form-control"  placeholder="cedula" value="{{old('username')}}">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Contraseña</label>
    <input type="password" name="password" class="form-control"  placeholder="Password" value="{{old('password')}}">
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Email</label>
    <input type="text" name="email" class="form-control"  placeholder="email" value="{{old('email')}}">
  </div>


  <div class="form-group">
    <label for="exampleInputPassword1">Perfil</label>
    <select class="form-control" name="rol">
    @if(old('rol') == 1)
      <option value="1" selected>Administrador</option>
      <option value="2">usuario</option>
    @else
      <option value="1" >Administrador</option>
      <option value="2" selected>usuario</option>
    @endif
    </select>
  </div>
  <button type="submit" class="btn btn-primary">Crear</button>
  <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
</form>
   </div>
</div>

@endsection