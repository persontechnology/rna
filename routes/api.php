<?php

use App\Http\Controllers\PacienteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/guardar-paciente', [PacienteController::class, 'guardar']);
Route::post('/eliminar-paciente', [PacienteController::class, 'eliminar']);
Route::get('/pacientes/{cedula?}', [PacienteController::class, 'index']);
Route::get('/pulsos', [PacienteController::class, 'pulsos']);
Route::get('/pulsos-v', [PacienteController::class, 'pulsos_v']);
Route::post('/historial-guardar', [PacienteController::class, 'guaradarHistorial']);
Route::get('/listado-historials/{paciente?}', [PacienteController::class, 'listadoHistorial']);

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
