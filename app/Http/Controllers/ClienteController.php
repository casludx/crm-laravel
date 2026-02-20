<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes.index', compact('clientes'));
    }
    
    public function show(Cliente $cliente)
    {   
        return redirect()->route('clientes.index');
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'email' => 'required|email|unique:clientes',
            'telefono' => 'required',
            'direccion' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $datos = $request->all();

        // Subir la foto si existe
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $nombreFoto = time() . '_' . $foto->getClientOriginalName();
            $ruta = $foto->storeAs('clientes', $nombreFoto, 'public');
            $datos['foto'] = $ruta;
        }

        Cliente::create($datos);
        return redirect()->route('clientes.index')->with('success', 'Cliente creado correctamente');
    }

    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nombre' => 'required',
            'email' => 'required|email|unique:clientes,email,'.$cliente->id,
            'telefono' => 'required',
            'direccion' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $datos = $request->all();

        // Subir nueva foto si existe
        if ($request->hasFile('foto')) {
            // Eliminar foto anterior si existe
            if ($cliente->foto && Storage::disk('public')->exists($cliente->foto)) {
                Storage::disk('public')->delete($cliente->foto);
            }
            
            $foto = $request->file('foto');
            $nombreFoto = time() . '_' . $foto->getClientOriginalName();
            $ruta = $foto->storeAs('clientes', $nombreFoto, 'public');
            $datos['foto'] = $ruta;
        }

        $cliente->update($datos);
        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado correctamente');
    }

    public function destroy(Cliente $cliente)
    {
        if (Auth::user()->role != 'admin') {
        return redirect()->route('clientes.index')->with('error', 'No tienes permisos para eliminar');
        }
    
        if ($cliente->foto && Storage::disk('public')->exists($cliente->foto)) {
        Storage::disk('public')->delete($cliente->foto);
        }
    
        $cliente->delete();
        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado correctamente');
    }
}