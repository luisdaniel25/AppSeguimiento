<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\ProfileController; // ← agrega este
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

/* Ruta inicial */
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

Route::get('/clear', function () {
    Artisan::call('optimize:clear');
    return "Cache limpiado correctamente";
});

/* Dashboard */
Route::get('/home', [HomeController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');

/* Rutas protegidas */
Route::middleware(['auth'])->group(function () {

    // Aprendices
    Route::resource('aprendices-sena', \App\Http\Controllers\AprendicesController::class)
        ->names('aprendices');

    // Centros
    Route::resource('centros-formacion', \App\Http\Controllers\CentrodeformacionController::class)
        ->names('centros');

    // Ente conformador
    Route::resource('enteconformador', \App\Http\Controllers\EnteconformadorController::class)
        ->names('enteconformador');

    // EPS
    Route::resource('eps', \App\Http\Controllers\EpsController::class)
        ->names('eps');

    // Fichas
    Route::resource('fichas-caracterizacion', \App\Http\Controllers\FichasdecaracterizacionController::class)
        ->names('fichas');

    // Instructores
    Route::resource('instructores-sena', \App\Http\Controllers\InstructoresController::class)
        ->names('instructores');

    // Programas
    Route::resource('programas-de-formacion', \App\Http\Controllers\ProgramasdeformacionController::class)
        ->names('programas');

    // Regionales
    Route::resource('regionales', \App\Http\Controllers\RegionalesController::class)
        ->names('regionales');

    // Roles administrativos
    Route::resource('rolesadministrativos', \App\Http\Controllers\RolesadministrativosController::class)
        ->names('rolesadministrativos');

    // Tipos documento
    Route::resource('tiposdocumento', \App\Http\Controllers\TiposdocumentoController::class)
        ->names('tiposdocumento');

    // Usuarios
    Route::resource('usuarios', \App\Http\Controllers\UserController::class)
        ->names('usuarios');

    // Archivos - Descargar
    Route::get('archivos-bitacora/{archivo}/download', [\App\Http\Controllers\ArchivoController::class, 'download'])
        ->name('archivos.download');

    // Archivos - CRUD
    Route::resource('archivos-bitacora', \App\Http\Controllers\ArchivoController::class)
        ->names('archivos');

    // ── Perfil admin ─────────────────────────────────────────
    Route::prefix('admin')->group(function () {

        Route::get('/profile', [ProfileController::class, 'index'])
            ->name('admin.profile');

        Route::put('/profile', [ProfileController::class, 'update'])
            ->name('admin.profile.update');

        Route::get('/change-password', [ProfileController::class, 'changePassword'])
            ->name('admin.change.password');

        Route::put('/change-password', [ProfileController::class, 'updatePassword'])
            ->name('admin.change.password.update');

    });

});
