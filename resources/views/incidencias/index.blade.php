<!DOCTYPE html>
<html>
<head>
    <title>Incidencias</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #4CAF50; color: white; }
        .btn { padding: 5px 10px; margin: 2px; text-decoration: none; color: white; border-radius: 3px; }
        .btn-success { background-color: #4CAF50; }
        .btn-primary { background-color: #008CBA; }
        .btn-danger { background-color: #f44336; }
        nav { margin-bottom: 20px; background-color: #333; padding: 10px; }
        nav a { color: white; padding: 10px; text-decoration: none; }
        nav a:hover { background-color: #575757; }
        .estado-pendiente { background-color: #ffeb3b; }
        .estado-proceso { background-color: #2196F3; color: white; }
        .estado-resuelta { background-color: #4CAF50; color: white; }
    </style>
</head>
<body>
    <nav>
        <a href="{{ route('clientes.index') }}">Clientes</a>
        <a href="{{ route('proveedores.index') }}">Proveedores</a>
        <a href="{{ route('empleados.index') }}">Empleados</a>
        <a href="{{ route('facturas.index') }}">Facturas</a>
        <a href="{{ route('incidencias.index') }}">Incidencias</a>
    
        <div style="float: right;">
            <span style="color: white; margin-right: 15px;">
                👤 {{ Auth::user()->name }} 
                @if(Auth::user()->role == 'admin')
                    <span style="background-color: #ff9800; padding: 2px 6px; border-radius: 3px; font-size: 11px;">ADMIN</span>
                @endif
            </span>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" style="background-color: #f44336; color: white; border: none; padding: 10px; cursor: pointer; border-radius: 3px;">Cerrar Sesión</button>
            </form>
        </div>
    </nav>

    <h1>Listado de Incidencias</h1>
    <a href="{{ route('incidencias.create') }}" class="btn btn-success">Nueva Incidencia</a>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($incidencias as $incidencia)
            <tr>
                <td>{{ $incidencia->id }}</td>
                <td>{{ $incidencia->titulo }}</td>
                <td>{{ $incidencia->descripcion }}</td>
                <td>
                    <span class="estado-{{ strtolower($incidencia->estado) }}" style="padding: 5px 10px; border-radius: 3px;">
                        {{ $incidencia->estado }}
                    </span>
                </td>
                <td>{{ $incidencia->fecha }}</td>
                <td>
                    <a href="{{ route('incidencias.edit', $incidencia) }}" class="btn btn-primary">Editar</a>
    
                    @if(Auth::user()->role == 'admin')
                        <form action="{{ route('incidencias.destroy', $incidencia) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>