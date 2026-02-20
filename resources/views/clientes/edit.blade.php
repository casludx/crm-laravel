<!DOCTYPE html>
<html>
<head>
    <title>Editar Cliente</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        form { max-width: 500px; }
        label { display: block; margin-top: 10px; }
        input, textarea { width: 100%; padding: 8px; margin-top: 5px; }
        button { margin-top: 15px; padding: 10px 20px; background-color: #008CBA; color: white; border: none; cursor: pointer; }
        .error { color: red; font-size: 12px; }
    </style>
</head>
<body>
    <h1>Editar Cliente</h1>

    @if($errors->any())
        <div class="error">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('clientes.update', $cliente) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <label>Nombre:</label>
        <input type="text" name="nombre" value="{{ $cliente->nombre }}" required>

        <label>Email:</label>
        <input type="email" name="email" value="{{ $cliente->email }}" required>

        <label>Teléfono:</label>
        <input type="text" name="telefono" value="{{ $cliente->telefono }}" required>

        <label>Dirección:</label>
        <input type="text" name="direccion" value="{{ $cliente->direccion }}" required>

        <label>Foto actual:</label>
        @if($cliente->foto)
            <img src="{{ asset('storage/'.$cliente->foto) }}" width="100" style="display: block; margin: 10px 0;">
        @else
            <p>Sin foto</p>
        @endif

        <label>Cambiar foto:</label>
        <input type="file" name="foto" accept="image/*">

        <button type="submit">Actualizar</button>
        <a href="{{ route('clientes.index') }}">Cancelar</a>
    </form>
</body>
</html>