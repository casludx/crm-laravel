<?php

namespace App\Http\Controllers;

use App\Models\Incidencia;
use Illuminate\Http\Request;

class IncidenciaController extends Controller
{
    public function index()
    {
        $incidencias = Incidencia::all();
        return view('incidencias.index', compact('incidencias'));
    }

    public function create()
    {
        return view('incidencias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required',
            'descripcion' => 'required',
            'estado' => 'required',
            'fecha' => 'required|date',
        ]);

        Incidencia::create($request->all());
        return redirect()->route('incidencias.index')->with('success', 'Incidencia creada correctamente');
    }

    public function edit(Incidencia $incidencia)
    {
        return view('incidencias.edit', compact('incidencia'));
    }

    public function update(Request $request, Incidencia $incidencia)
    {
        $request->validate([
            'titulo' => 'required',
            'descripcion' => 'required',
            'estado' => 'required',
            'fecha' => 'required|date',
        ]);

        $incidencia->update($request->all());
        return redirect()->route('incidencias.index')->with('success', 'Incidencia actualizada correctamente');
    }

    public function destroy(Incidencia $incidencia)
    {
        $incidencia->delete();
        return redirect()->route('incidencias.index')->with('success', 'Incidencia eliminada correctamente');
    }
}