<?php

use App\Livewire\PaginaProjetoCriarSprint;
use App\Livewire\PaginaProjetos;
use App\Livewire\PaginaProjetoSprints;
use App\Livewire\PaginaSprintAlterar;
use App\Livewire\PaginaSprintBacklog;
use App\Livewire\PaginaSprintDetalhar;
use App\Livewire\PaginaSprintReport;
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

Route::get('/', PaginaProjetos::class)->name('pagina-projetos');
Route::get('projetos/{projetoId}/sprints', PaginaProjetoSprints::class)->name('pagina-projeto-sprints');
Route::get('projetos/{projetoId}/sprints/criar', PaginaProjetoCriarSprint::class)->name('pagina-projeto-criar-sprint');
Route::get('projetos/{projetoId}/sprints/{sprint}', PaginaSprintDetalhar::class)->name('pagina-sprint-detalhar');
Route::get('projetos/{projetoId}/sprints/{sprint}/report', PaginaSprintReport::class)->name('pagina-sprint-report');
Route::get('projetos/{projetoId}/sprints/{sprint}/backlog', PaginaSprintBacklog::class)->name('pagina-sprint-backlog');
Route::get('projetos/{projetoId}/sprints/{sprint}/alterar', PaginaSprintAlterar::class)->name('pagina-sprint-alterar');
