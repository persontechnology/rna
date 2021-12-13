<?php

use App\Http\Controllers\PacienteController;
use App\Models\Pulso;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/api/pulsos', [PacienteController::class, 'pulsos']);
Route::get('/api/pulsos-v', [PacienteController::class, 'pulsos_v']);

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/generar', function () {
    $random_number_array = range(0, 500);
    shuffle($random_number_array );
    $random_number_array = array_slice($random_number_array ,0,500);

    $p=Pulso::first();
    $p->data=$random_number_array;
    $p->save();
    return $p->data;
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
