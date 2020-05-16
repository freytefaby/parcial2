@extends('layouts.layaut')

@section('content')
<h1>Bienvenido {{Auth::user()->name}}  @if(Auth::user()->rol_fk == 1) Administrador @else Usuario @endif</h1> 
@endsection
