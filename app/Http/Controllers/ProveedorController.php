<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProveedorController extends Controller
{
    public function index()
    {
        $proveedores = Proveedor::all();
        return view('proveedores.index', compact('proveedores'));
    }
    
    public function show(Proveedor $proveedore)
    {
        return redirect()->route('proveedores.index');
    }

    public function create()
    {
        return view('proveedores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'empresa' => 'required',
            'email' => 'required|email|unique:proveedors',
            'telefono' => 'required',
            'documento' => 'nullable|mimes:pdf|max:5120',
        ]);

        $datos = $request->all();

        // Subir el documento si existe
        if ($request->hasFile('documento')) {
            $documento = $request->file('documento');
            $nombreDocumento = time() . '_' . $documento->getClientOriginalName();
            $ruta = $documento->storeAs('proveedores', $nombreDocumento, 'public');
            $datos['documento'] = $ruta;
        }

        Proveedor::create($datos);
        return redirect()->route('proveedores.index')->with('success', 'Proveedor creado correctamente');
    }

    public function edit(Proveedor $proveedore)
    {
        return view('proveedores.edit', compact('proveedore'));
    }

    public function update(Request $request, Proveedor $proveedore)
    {
        $request->validate([
            'nombre' => 'required',
            'empresa' => 'required',
            'email' => 'required|email|unique:proveedors,email,'.$proveedore->id,
            'telefono' => 'required',
            'documento' => 'nullable|mimes:pdf|max:5120',
        ]);

        $datos = $request->all();

        // Subir nuevo documento si existe
        if ($request->hasFile('documento')) {
            // Eliminar documento anterior si existe
            if ($proveedore->documento && Storage::disk('public')->exists($proveedore->documento)) {
                Storage::disk('public')->delete($proveedore->documento);
            }
            
            $documento = $request->file('documento');
            $nombreDocumento = time() . '_' . $documento->getClientOriginalName();
            $ruta = $documento->storeAs('proveedores', $nombreDocumento, 'public');
            $datos['documento'] = $ruta;
        }

        $proveedore->update($datos);
        return redirect()->route('proveedores.index')->with('success', 'Proveedor actualizado correctamente');
    }

    public function destroy(Proveedor $proveedore)
    {
        if (Auth::user()->role != 'admin') {
            return redirect()->route('proveedores.index')->with('error', 'No tienes permisos para eliminar');
        }
        if ($proveedore->documento && Storage::disk('public')->exists($proveedore->documento)) {
            Storage::disk('public')->delete($proveedore->documento);
        }
    
        $proveedore->delete();
        return redirect()->route('proveedores.index')->with('success', 'Proveedor eliminado correctamente');
    }
}