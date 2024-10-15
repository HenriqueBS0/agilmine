<?php

use App\Livewire\AlterarSprint;
use App\Livewire\CriarSprint;
use App\Livewire\DetalharSprint;
use App\Livewire\ProjetoPage;
use App\Livewire\ProjetosPage;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/projetos', ProjetosPage::class)->name('projetos-list');
Route::get('/projetos/{id}', ProjetoPage::class)->name('projetos-item');
Route::get('/projetos/{id}/sprint/criar', CriarSprint::class)->name('criar-sprint');
Route::get('/projetos/{id}/sprint/{sprint}/alterar', AlterarSprint::class)->name('alterar-sprint');
Route::get('/projetos/{id}/sprint/{sprint}/detalhar', DetalharSprint::class)->name('datalhar-sprint');
