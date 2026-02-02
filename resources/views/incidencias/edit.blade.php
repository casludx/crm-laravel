<!DOCTYPE html>
<html>
<head>
    <title>Editar Incidencia</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        form { max-width: 500px; }
        label { display: block; margin-top: 10px; }
        input, textarea, select { width: 100%; padding: 8px; margin-top: 5px; }
        textarea { min-height: 100px; }
        button { margin-top: 15px; padding: 10px 20px; background-color: #008CBA; color: white; border: none; cursor: pointer; }
        .error { color: red; font-size: 12px; }
    </style>
</head>
<body>
    <h1>Editar Incidencia</h1>

    @if($errors->any())
        <div class="error">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('incidencias.update', $incidencia) }}" method="POST">
        @csrf
        @method('PUT')
        
        <label>Título:</label>
        <input type="text" name="titulo" value="{{ $incidencia->titulo }}" required>

        <label>Descripción:</label>
        <textarea name="descripcion" required>{{ $incidencia->descripcion }}</textarea>

        <label>Estado:</label>
        <select name="estado" required>
            <option value="Pendiente" {{ $incidencia->estado == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
            <option value="Proceso" {{ $incidencia->estado == 'Proceso' ? 'selected' : '' }}>En Proceso</option>
            <option value="Resuelta" {{ $incidencia->estado == 'Resuelta' ? 'selected' : '' }}>Resuelta</option>
        </select>

        <label>Fecha:</label>
        <input type="date" name="fecha" value="{{ $incidencia->fecha }}" required>

        <button type="submit">Actualizar</button>
        <a href="{{ route('incidencias.index') }}">Cancelar</a>
    </form>
</body>
</html>