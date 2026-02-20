<!DOCTYPE html>
<html>
<head>
    <title>Clientes</title>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    
    <style>
        body { font-family: Arial; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #4CAF50; color: white; }
        .btn { padding: 5px 10px; margin: 2px; text-decoration: none; color: white; border-radius: 3px; display: inline-block; }
        .btn-success { background-color: #4CAF50; }
        .btn-primary { background-color: #008CBA; }
        .btn-danger { background-color: #f44336; }
        nav { margin-bottom: 20px; background-color: #333; padding: 10px; }
        nav a { color: white; padding: 10px; text-decoration: none; }
        nav a:hover { background-color: #575757; }
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

    <h1>Listado de Clientes</h1>
    <a href="{{ route('clientes.create') }}" class="btn btn-success">Nuevo Cliente</a>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <table id="tablaClientes">
    <thead>
        <tr>
            <th>ID</th>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Teléfono</th>
            <th>Dirección</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($clientes as $cliente)
        <tr>
            <td>{{ $cliente->id }}</td>
            <td>
                @if($cliente->foto)
                    <img src="{{ asset('storage/'.$cliente->foto) }}" width="50" height="50" style="object-fit: cover; border-radius: 5px;">
                @else
                    <span style="color: gray;">Sin foto</span>
                @endif
            </td>
            <td>{{ $cliente->nombre }}</td>
            <td>{{ $cliente->email }}</td>
            <td>{{ $cliente->telefono }}</td>
            <td>{{ $cliente->direccion }}</td>
            <td>
                <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-primary">Editar</a>
    
                @if(Auth::user()->role == 'admin')
                    <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" style="display: inline;">
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
        <script>
            $(document).ready(function() {
                $('#tablaClientes').DataTable({
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json'
                    }
                });
            });
    </script>
</body>
</html>