@extends('layouts.layaut')
@section('content')

<div class="card">
  <div class="card-body">
  Editar libros<br><br>
  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif
  <form method="post" action="/libros/update">
  <div class="form-group">
    <label for="exampleInputEmail1">Nombre</label>
    <input type="text" name="nombre" class="form-control"  placeholder="Nombre" value="{{$libro->nombre}}">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Paginas</label>
    <input type="text" name="paginas" class="form-control"  placeholder="Cedula" value="{{$libro->paginas}}">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">categorias</label>
    <select class="form-control" name="categoria">
        <option value="0">Seleccione...</option>
        @foreach($categorias as $cat)
            @if(old('categoria') == $cat->id)
            <option value="{{$cat->id}}" selected>{{$cat->descripcion}}</option>
            @elseif($libro->categorias_fk == $cat->id)
            <option value="{{$cat->id}}" selected>{{$cat->descripcion}}</option>
            @else
            <option value="{{$cat->id}}">{{$cat->descripcion}}</option>
            @endif
        @endforeach
    
    </select>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Codigo ISBN</label>
    <input type="text" name="isbn" class="form-control"  placeholder="isbn" value="{{$libro->isbn}}">
  </div>
  
  

  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <input type="hidden" name="id" value="{{$libro->id}}">
  <button type="submit" class="btn btn-primary">Editar</button>
  
</form>
   </div>
</div>

@endsection