<!DOCTYPE html>
<html>
<head>
    <title>Editar Proveedor</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        form { max-width: 500px; }
        label { display: block; margin-top: 10px; }
        input { width: 100%; padding: 8px; margin-top: 5px; }
        button { margin-top: 15px; padding: 10px 20px; background-color: #008CBA; color: white; border: none; cursor: pointer; }
        .error { color: red; font-size: 12px; }
    </style>
</head>
<body>
    <h1>Editar Proveedor</h1>

    @if($errors->any())
        <div class="error">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('proveedores.update', $proveedore) }}" method="POST">
        @csrf
        @method('PUT')
        
        <label>Nombre:</label>
        <input type="text" name="nombre" value="{{ $proveedore->nombre }}" required>

        <label>Empresa:</label>
        <input type="text" name="empresa" value="{{ $proveedore->empresa }}" required>

        <label>Email:</label>
        <input type="email" name="email" value="{{ $proveedore->email }}" required>

        <label>Teléfono:</label>
        <input type="text" name="telefono" value="{{ $proveedore->telefono }}" required>

        <button type="submit">Actualizar</button>
        <a href="{{ route('proveedores.index') }}">Cancelar</a>
    </form>
</body>
</html>