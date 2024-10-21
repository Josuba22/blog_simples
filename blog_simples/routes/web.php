<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostagemController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\ProfileController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Rotas para as postagens
Route::get('/', [PostagemController::class, 'index'])->name('postagens.index');
Route::get('/postagens/{postagem}', [PostagemController::class, 'mostrar'])->name('postagens.show');


//Rotas para os comentários (aninhadas às rotas de postagens)
Route::post('/postagens/{postagem}/comentarios', [ComentarioController::class, 'armazenar'])->name('comentarios.armazenar');

require __DIR__.'/auth.php';
