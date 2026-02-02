<!DOCTYPE html>
<html>
<head>
    <title>Nueva Factura</title>
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
    <h1>Nueva Factura</h1>

    @if($errors->any())
        <div class="error">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('facturas.store') }}" method="POST">
        @csrf
        <label>Número de Factura:</label>
        <input type="text" name="numero_factura" value="{{ old('numero_factura') }}" required>

        <label>Fecha:</label>
        <input type="date" name="fecha" value="{{ old('fecha') }}" required>

        <label>Cliente:</label>
        <input type="text" name="cliente" value="{{ old('cliente') }}" required>

        <label>Total (€):</label>
        <input type="number" step="0.01" name="total" value="{{ old('total') }}" required>

        <button type="submit">Guardar</button>
        <a href="{{ route('facturas.index') }}">Cancelar</a>
    </form>
</body>
</html>