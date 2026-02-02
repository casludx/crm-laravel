<!DOCTYPE html>
<html>
<head>
    <title>Editar Factura</title>
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
    <h1>Editar Factura</h1>

    @if($errors->any())
        <div class="error">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('facturas.update', $factura) }}" method="POST">
        @csrf
        @method('PUT')
        
        <label>Número de Factura:</label>
        <input type="text" name="numero_factura" value="{{ $factura->numero_factura }}" required>

        <label>Fecha:</label>
        <input type="date" name="fecha" value="{{ $factura->fecha }}" required>

        <label>Cliente:</label>
        <input type="text" name="cliente" value="{{ $factura->cliente }}" required>

        <label>Total (€):</label>
        <input type="number" step="0.01" name="total" value="{{ $factura->total }}" required>

        <button type="submit">Actualizar</button>
        <a href="{{ route('facturas.index') }}">Cancelar</a>
    </form>
</body>
</html>