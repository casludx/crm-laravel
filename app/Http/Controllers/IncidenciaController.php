<?php

namespace App\Http\Controllers;

use App\Models\Incidencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncidenciaController extends Controller
{
    public function index()
    {
        $incidencias = Incidencia::all();
        return view('incidencias.index', compact('incidencias'));
    }

    public function show(Incidencia $incidencia)
    {
        return redirect()->route('incidencias.index');
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
        if (Auth::user()->role != 'admin') {
            return redirect()->route('incidencias.index')->with('error', 'No tienes permisos para eliminar');
        }
    
        $incidencia->delete();
        return redirect()->route('incidencias.index')->with('success', 'Incidencia eliminada correctamente');
    }
}