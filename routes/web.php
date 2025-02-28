<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FilteredFacturesController;
use App\Http\Controllers\TableUsersController;
use App\Http\Controllers\TableFacturasController;
use App\Http\Controllers\TableConceptosController;
use App\Http\Controllers\TableDocentesController;
use App\Http\Controllers\TablePeriodosController;
use App\Http\Controllers\TableCuentasController;
use App\Http\Controllers\TableOfertasController;
use App\Http\Controllers\TablePlantelesController;
use App\Http\Controllers\TableAsignaturasController;

// rutas de autenticación
Auth::routes();

//ruta principal (login)
Route::get('/', function () {
    return view('auth/login');
})->name('app');

// página principal después del login
Route::get('/home', [HomeController::class, 'index'])->name('home');

//tabla facturas
Route::resource('facturas', TableFacturasController::class);
Route::delete('facturas/destroyMultiple', [TableFacturasController::class, 'destroyMultiple'])->name('facturas.destroyMultiple');

//tabla usuarios
Route::resource('usuarios', TableUsersController::class);
Route::delete('/usuarios/destroy-multiple', [UsuarioController::class, 'destroyMultiple'])->name('usuarios.destroyMultiple');

//tabla docentes
Route::resource('docentes', TableDocentesController::class);
Route::post('/docentes/delete-selected', [TableDocentesController::class, 'deleteSelected'])->name('docentes.deleteSelected');

//tabla periodos
Route::resource('periodos', TablePeriodosController::class);
Route::delete('periodos/destroyMultiple', [TablePeriodosController::class, 'destroyMultiple'])->name('periodos.destroyMultiple');

//tabla conceptos
Route::resource('conceptos', TableConceptosController::class);
Route::delete('/conceptos/destroy-multiple', [TableConceptosController::class, 'destroyMultiple'])->name('conceptos.destroyMultiple');

//tabla bancos
Route::resource('bancos', TableCuentasController::class);
Route::delete('/bancos/destroy-multiple', [TableCuentasController::class, 'destroyMultiple'])->name('bancos.destroyMultiple');

//tabla planteles
Route::resource('planteles', TablePlantelesController::class);
Route::delete('planteles/destroy-multiple', [TablePlantelesController::class, 'destroyMultiple'])->name('planteles.destroyMultiple');

//tabla ofertas educativas
Route::resource('ofertas', TableOfertasController::class);
Route::delete('/ofertas/eliminar-multiples', [OfertasController::class, 'destroyMultiple'])->name('ofertas.destroyMultiple');

//tabla asignaturas
Route::resource('asignaturas', TableAsignaturasController::class);
Route::delete('asignaturas/destroyMultiple', [TableAsignaturasController::class, 'destroyMultiple'])->name('asignaturas.destroyMultiple');

//facturas Filtradas
Route::resource('filtered-factures', FilteredFacturesController::class);

// routes/web.php
Route::get('/get-docentes', [TableDocentesController::class, 'getDocentes']);
Route::get('/get-bancos', [TableCuentasController::class, 'getBancos']);

//vista de PDF de factura
Route::get('/factura/{id}/ver', [ArchiveController::class, 'mostrarPdf']);

#Route::get('/test-insert', function () {
#    $docente = \App\Models\Docente::create([
#        'nombre_docente' => 'Juan Pérez',
#        'asignatura' => 'Matemáticas',
#        'oferta_educativa_id' => 1,
#        'periodos_pago_id' => 1, 
#        'importe_pago' => 2000,
#    ]);

#   return response()->json($docente);
#});
