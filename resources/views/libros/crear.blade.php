@extends('layouts.layaut')
@section('content')

<div class="card">
  <div class="card-body">
  Crear libros<br><br>
  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif
  <form method="post" action="/libros/store">
  <div class="form-group">
    <label for="exampleInputEmail1">Nombre</label>
    <input type="text" name="nombre" class="form-control"  placeholder="Nombre" value="{{old('nombre')}}">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Paginas</label>
    <input type="number" name="paginas" class="form-control"  placeholder="paginas" value="{{old('paginas')}}">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Categorias</label>
    <select class="form-control" name="categoria">
        <option value="0">Seleccione...</option>
        @foreach($categorias as $cat)
            @if(old('categoria') == $cat->id)
            <option value="{{$cat->id}}" selected>{{$cat->descripcion}}</option>
            @else
            <option value="{{$cat->id}}">{{$cat->descripcion}}</option>
            @endif
        @endforeach
    
    </select>
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Codigo ISBN</label>
    <input type="text" name="isbn" class="form-control"  placeholder="isbn" value="{{old('isbn')}}">
  </div>

  <button type="submit" class="btn btn-primary">Crear</button>
  <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
</form>
   </div>
</div>

@endsection