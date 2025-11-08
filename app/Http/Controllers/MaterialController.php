<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    /**
     * Mostrar todos los materiales.
     */
    public function index()
    {
        $materiales = Material::all();
        return view('materiales.index', compact('materiales'));
    }

    /**
     * Mostrar el formulario para crear un nuevo material.
     */
    public function create()
    {
        return view('materiales.create');
    }

    /**
     * Guardar un nuevo material en la base de datos.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255|unique:materiales,nombre',
            'descripcion' => 'nullable|string|max:500',
            'cantidad' => 'required|integer|min:0',
            'estado' => 'required|string|in:activo,inactivo',
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.unique' => 'Ya existe un material con ese nombre.',
            'cantidad.required' => 'Debes ingresar una cantidad.',
            'cantidad.integer' => 'La cantidad debe ser un número entero.',
            'estado.required' => 'Debes seleccionar un estado.',
        ]);

        Material::create($validated);

        return redirect()->route('materiales.index')
            ->with('success', 'Material creado correctamente.');
    }

    /**
     * Mostrar formulario de edición.
     */
    public function edit(Material $material)
    {
        return view('materiales.edit', compact('material'));
    }

    /**
     * Actualizar un material existente.
     */
    public function update(Request $request, Material $material)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255|unique:materiales,nombre,' . $material->id,
            'descripcion' => 'nullable|string|max:500',
            'cantidad' => 'required|integer|min:0',
            'estado' => 'required|string|in:activo,inactivo',
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.unique' => 'Ya existe un material con ese nombre.',
            'cantidad.required' => 'Debes ingresar una cantidad.',
            'cantidad.integer' => 'La cantidad debe ser un número entero.',
            'estado.required' => 'Debes seleccionar un estado.',
        ]);

        $material->update($validated);

        return redirect()->route('materiales.index')
            ->with('success', 'Material actualizado correctamente.');
    }

    /**
     * Eliminar un material.
     */
    public function destroy(Material $material)
    {
        $material->delete();

        return redirect()->route('materiales.index')
            ->with('success', 'Material eliminado correctamente.');
    }
}
