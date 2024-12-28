<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Middleware\AdminMiddleware;
use App\Livewire\Home\Configuracoes\Pagina as PaginaConfiguracoes;
use App\Livewire\Home\Usuarios\Pagina as PaginaUsuarios;
use App\Livewire\Home\Projetos\Pagina as PaginaProjetos;
use App\Livewire\Home\ProjetosArquivados\Pagina as PaginaProjetosArquivados;
use App\Livewire\Projeto\Report\Pagina as PaginaProjetoReport;
use App\Livewire\Projeto\Backlog\Pagina as PaginaProjetoBacklog;
use App\Livewire\Projeto\Kanban\Pagina as PaginaProjetoKanban;
use App\Livewire\Projeto\Membros\Pagina as PaginaProjetoMembros;
use App\Livewire\Projeto\Configuracoes\Pagina as PaginaProjetoConfiguracoes;
use App\Livewire\Projeto\Sprints\Pagina as PaginaProjetoSprints;
use App\Livewire\Projeto\CriarSprint\Pagina as PaginaProjetoCriarSprint;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('welcome');

    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware(['auth', 'check.user.status'])->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    Route::get('usuarios', PaginaUsuarios::class)->middleware([AdminMiddleware::class])->name('pagina-usuarios');
    Route::get('configuracoes', PaginaConfiguracoes::class)->middleware([AdminMiddleware::class])->name('pagina-configuracoes');

    Route::prefix('projetos')->middleware(['sync.projects'])->group(function () {
        Route::get('/', PaginaProjetos::class)->name('pagina-projetos');
        Route::get('/arquivados', PaginaProjetosArquivados::class)->name('pagina-projetos-arquivados');
        Route::get('/{projeto}/report', PaginaProjetoReport::class)->name('pagina-projeto-report');
        Route::get('/{projeto}/backlog', PaginaProjetoBacklog::class)->name('pagina-projeto-backlog');
        Route::get('/{projeto}/kanban', PaginaProjetoKanban::class)->name('pagina-projeto-kanban');
        Route::get('/{projeto}/membros', PaginaProjetoMembros::class)->name('pagina-projeto-membros');
        Route::get('/{projeto}/configuracoes', PaginaProjetoConfiguracoes::class)
            ->middleware('can:isGestor,projeto')
            ->name('pagina-projeto-configuracoes');
        Route::get('/{projeto}/sprints', PaginaProjetoSprints::class)->name('pagina-projeto-sprints');

        Route::get('/{projeto}/criar-sprint', PaginaProjetoCriarSprint::class)
            ->middleware('can:isGestor,projeto')
            ->name('pagina-projeto-criar-sprint');

    });

    // Route::get('projetos/{projetoId}/sprints/criar', PaginaProjetoCriarSprint::class)->name('pagina-projeto-criar-sprint');
    // Route::get('projetos/{projetoId}/sprints/{sprint}', PaginaSprintDetalhar::class)->name('pagina-sprint-detalhar');
    // Route::get('projetos/{projetoId}/sprints/{sprint}/report', PaginaSprintReport::class)->name('pagina-sprint-report');
    // Route::get('projetos/{projetoId}/sprints/{sprint}/backlog', PaginaSprintBacklog::class)->name('pagina-sprint-backlog');
    // Route::get('projetos/{projetoId}/sprints/{sprint}/alterar', PaginaSprintAlterar::class)->name('pagina-sprint-alterar');
});
