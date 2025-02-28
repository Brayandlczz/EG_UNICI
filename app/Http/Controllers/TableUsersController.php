<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class TableUsersController extends Controller
{
    public function index()
    {
        if (Auth::user()->rol->rol !== 'admin') {
            return redirect()->route('home')->with('error', 'No tienes acceso a esta sección.');
        }

        $users = User::with('rol')->get();
        return view('tables.users', compact('users'));
    }

    public function create()
    {
        $roles = Rol::all(); 
        return view('users_view.users', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'rol_id' => 'required|exists:roles,id', 
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'rol_id' => $validated['rol_id'], 
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado correctamente.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Rol::all();
        return view('users_view.users', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'rol_id' => 'required|exists:roles,id',
            'password' => 'nullable|string|min:8|confirmed', 
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'rol_id' => $validated['rol_id'],
            'password' => $validated['password'] ? Hash::make($validated['password']) : $user->password,
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
