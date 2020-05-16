<h3>@Has registrado un nuevo usuario de la base de datos</h3>
<table border="1px">
    <tr>
        <td>Id</td>
        <td>Nombre</td>
        <td>Correo</td>
        <td>Perfil</td>
        <td>Contraseña</td>
    </tr>

    @if($usuarios)
        <tr>
            <td>{{$usuarios->id}}</td>
            <td>{{$usuarios->name}}</td>
            <td>{{$usuarios->email}}</td>
            <td>@if($usuarios->perfil == 1)
                    Administrador
                @else
                    usuario
                @endif
            </td>
            <td>{{$usuarios->password}}</td>
        
        
        </tr>

    @endif

</table>