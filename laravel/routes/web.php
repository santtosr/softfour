<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth/login');
})->name('inicial');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('inicio');

Route::get('/inicio', function () {
    return view('dashboard');
})->middleware(['auth'])->name('inicio');

Route::get(
    '/filmes',[\App\Http\Controllers\FilmesController::class, 'listarFilmes']
)->middleware(['auth'])->name('filmes');

Route::get(
    '/filmes/listar',[\App\Http\Controllers\FilmesController::class, 'listarFilmes']
)->middleware(['auth'])->name('listarFilmes');

Route::get('/filmes/inserir', function () {
    return view('filmes/inserirFilme');
})->middleware(['auth'])->name('inserirFilme');

Route::post('/filmes/inserir/registrar',[\App\Http\Controllers\FilmesController::class, 'registrarFilme'])->middleware(['auth']);

Route::get('/filmes/deletar', [\App\Http\Controllers\FilmesController::class, 'deletarFilme'])->middleware(['auth'])->name('deletarFilme');

Route::get('/filmes/atualizar', [\App\Http\Controllers\FilmesController::class, 'viewAtualizar'])->middleware(['auth'])->name('atualizarFilme');

Route::post('/filmes/atualizar/salvar', [\App\Http\Controllers\FilmesController::class, 'atualizarFilme'])->middleware(['auth'])->name('salvarAtualizacaoFilme');

Route::get(
    '/series',[\App\Http\Controllers\SeriesController::class, 'listarSeries']
)->middleware(['auth'])->name('series');

Route::get(
    '/series/listar',[\App\Http\Controllers\SeriesController::class, 'listarSeries']
)->middleware(['auth'])->name('listarSeries');

Route::get('/series/inserir', function () {
    return view('series/inserirSerie');
})->middleware(['auth'])->name('inserirSerie');

Route::post('/series/inserir/registrar',[\App\Http\Controllers\SeriesController::class, 'registrarSerie'])->middleware(['auth']);

Route::get('/series/deletar', [\App\Http\Controllers\SeriesController::class, 'deletarSerie'])->middleware(['auth'])->name('deletarSerie');

Route::get('/series/atualizar', [\App\Http\Controllers\SeriesController::class, 'viewAtualizar'])->middleware(['auth'])->name('atualizarSerie');

Route::post('/series/atualizar/salvar', [\App\Http\Controllers\SeriesController::class, 'atualizarSerie'])->middleware(['auth'])->name('salvarAtualizacaoSerie');

Route::get('/livros', function () {
    return view('livros/livros');
})->middleware(['auth'])->name('livros');

Route::get(
    '/livros',[\App\Http\Controllers\LivrosController::class, 'listarLivros']
)->middleware(['auth'])->name('livros');

Route::get(
    '/livros/listar',[\App\Http\Controllers\LivrosController::class, 'listarLivros']
)->middleware(['auth'])->name('listarLivros');

Route::get('/livros/inserir', function () {
    return view('livros/inserirLivro');
})->middleware(['auth'])->name('inserirLivro');

Route::post('/livros/inserir/registrar',[\App\Http\Controllers\LivrosController::class, 'registrarLivro'])->middleware(['auth']);

Route::get('/livros/deletar', [\App\Http\Controllers\LivrosController::class, 'deletarLivro'])->middleware(['auth'])->name('deletarLivro');

Route::get('/livros/atualizar', [\App\Http\Controllers\LivrosController::class, 'viewAtualizar'])->middleware(['auth'])->name('atualizarLivro');

Route::post('/livros/atualizar/salvar', [\App\Http\Controllers\LivrosController::class, 'atualizarLivro'])->middleware(['auth'])->name('salvarAtualizacaoLivro');

Route::get(
    '/comentarios/listar',[\App\Http\Controllers\ComentariosController::class, 'listarComentarios']
)->middleware(['auth'])->name('listarComentarios');

Route::get(
    '/comentarios/inserir',[\App\Http\Controllers\ComentariosController::class, 'inserirComentario']
)->middleware(['auth'])->name('inserirComentario');

Route::post('/comentarios/inserir/registrar',[\App\Http\Controllers\ComentariosController::class, 'registrarComentario'])->middleware(['auth']);

Route::get('/comentarios/deletar', [\App\Models\Comentario::class, 'deletarComentario'])->middleware(['auth'])->name('deletarComentario');

Route::get('/comentarios/atualizar', [\App\Http\Controllers\ComentariosController::class, 'viewAtualizar'])->middleware(['auth'])->name('atualizarComentario');

Route::post('/comentarios/atualizar/salvar', [\App\Http\Controllers\ComentariosController::class, 'atualizarComentario'])->middleware(['auth'])->name('salvarAtualizacaoComentario');

require __DIR__.'/auth.php';
