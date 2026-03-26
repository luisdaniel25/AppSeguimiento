<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.profile');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|unique:users,email,' . auth()->id(),
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $user = auth()->user();

        // ── Subida de avatar
        if ($request->hasFile('avatar')) {

            //  Nombre limpio del usuario
            $nombreLimpio = Str::slug($user->name);

            //  Carpeta: ID + nombre
            $carpeta = 'avatars/' . $user->id . '-' . $nombreLimpio;

            // Eliminar carpeta anterior
            Storage::disk('public')->deleteDirectory('avatars/' . $user->id . '-' . Str::slug($user->getOriginal('name')));

            $file = $request->file('avatar');
            $filename = time() . '.' . $file->getClientOriginalExtension();

            //  Guardar en carpeta personalizada
            $path = $file->storeAs($carpeta, $filename, 'public');

            $user->avatar = $path;
        }

        // Actualizar datos
        $user->name  = $request->name;
        $user->email = $request->email;
        $user->save();

        return back()->with('success', 'Perfil actualizado correctamente.');
    }

    public function changePassword()
    {
        return view('admin.change-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, auth()->user()->password)) {
            return back()->withErrors([
                'current_password' => 'La contraseña actual no es correcta.'
            ]);
        }

        auth()->user()->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Contraseña actualizada correctamente.');
    }
}
