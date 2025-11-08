<?php

namespace App\Http\Controllers;

use App\Models\Tecnico;
use Illuminate\Http\Request;

class TecnicoController extends Controller
{
    public function index()
    {
        $tecnicos = Tecnico::all(); // Trae todos los técnicos
        return view('tecnicos.index', compact('tecnicos'));
    }

    public function create()
    {
        return view('tecnicos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'estado' => 'required|string|in:activo,inactivo',
        ]);

        Tecnico::create($request->only('nombre', 'estado'));

        return redirect()->route('tecnicos.index')->with('success', 'Técnico creado correctamente.');
    }

    public function edit(Tecnico $tecnico)
    {
        return view('tecnicos.edit', compact('tecnico'));
    }

    public function update(Request $request, Tecnico $tecnico)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'estado' => 'required|string|in:activo,inactivo',
        ]);

        $tecnico->update($request->only('nombre', 'estado'));

        return redirect()->route('tecnicos.index')->with('success', 'Técnico actualizado correctamente.');
    }

    public function destroy(Tecnico $tecnico)
    {
        $tecnico->delete();
        return redirect()->route('tecnicos.index')->with('success', 'Técnico eliminado correctamente.');
    }
}
