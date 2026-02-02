<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use Illuminate\Http\Request;

class FacturaController extends Controller
{
    public function index()
    {
        $facturas = Factura::all();
        return view('facturas.index', compact('facturas'));
    }

    public function create()
    {
        return view('facturas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero_factura' => 'required|unique:facturas',
            'fecha' => 'required|date',
            'total' => 'required|numeric',
            'cliente' => 'required',
        ]);

        Factura::create($request->all());
        return redirect()->route('facturas.index')->with('success', 'Factura creada correctamente');
    }

    public function edit(Factura $factura)
    {
        return view('facturas.edit', compact('factura'));
    }

    public function update(Request $request, Factura $factura)
    {
        $request->validate([
            'numero_factura' => 'required|unique:facturas,numero_factura,'.$factura->id,
            'fecha' => 'required|date',
            'total' => 'required|numeric',
            'cliente' => 'required',
        ]);

        $factura->update($request->all());
        return redirect()->route('facturas.index')->with('success', 'Factura actualizada correctamente');
    }

    public function destroy(Factura $factura)
    {
        $factura->delete();
        return redirect()->route('facturas.index')->with('success', 'Factura eliminada correctamente');
    }
}