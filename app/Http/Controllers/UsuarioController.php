<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::orderBy('nombre')->paginate(10);
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:usuarios',
                'ends_with:@redecom.com',
            ],
            'password' => 'required|string|min:8|confirmed',
            'rol' => ['required', Rule::in(['administracion', 'supervisor', 'tecnico'])],
        ]);

        Usuario::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol' => $request->rol,
            'estado' => 'activo',
        ]);

        return redirect()
            ->route('usuarios.index')
            ->with('success', 'Usuario registrado correctamente.');
    }

    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('usuarios')->ignore($usuario->id),
            ],
            'rol' => ['required', Rule::in(['administracion', 'supervisor', 'tecnico'])],
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $usuario->update([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'rol' => $request->rol,
            'password' => $request->filled('password')
                ? Hash::make($request->password)
                : $usuario->password,
        ]);

        return redirect()
            ->route('usuarios.index')
            ->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();

        return redirect()
            ->route('usuarios.index')
            ->with('success', 'Usuario eliminado correctamente.');
    }

    public function inactivar($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->estado = $usuario->estado === 'activo' ? 'inactivo' : 'activo';
        $usuario->save();

        return redirect()
            ->route('usuarios.index')
            ->with('success', 'Estado del usuario actualizado correctamente.');
    }

    public function activar($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->estado = 'activo';
        $usuario->save();

        return redirect()
            ->route('usuarios.index')
            ->with('success', 'Usuario activado correctamente.');
    }
}
