<!DOCTYPE html>
<html>
<head>
    <title>Nuevo Empleado</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        form { max-width: 500px; }
        label { display: block; margin-top: 10px; }
        input { width: 100%; padding: 8px; margin-top: 5px; }
        button { margin-top: 15px; padding: 10px 20px; background-color: #4CAF50; color: white; border: none; cursor: pointer; }
        .error { color: red; font-size: 12px; }
    </style>
</head>
<body>
    <h1>Nuevo Empleado</h1>

    @if($errors->any())
        <div class="error">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('empleados.store') }}" method="POST">
        @csrf
        <label>Nombre:</label>
        <input type="text" name="nombre" value="{{ old('nombre') }}" required>

        <label>Puesto:</label>
        <input type="text" name="puesto" value="{{ old('puesto') }}" required>

        <label>Email:</label>
        <input type="email" name="email" value="{{ old('email') }}" required>

        <label>Salario (€):</label>
        <input type="number" step="0.01" name="salario" value="{{ old('salario') }}" required>

        <button type="submit">Guardar</button>
        <a href="{{ route('empleados.index') }}">Cancelar</a>
    </form>
</body>
</html>