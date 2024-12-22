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
use App\Livewire\Home\Usuarios\Pagina as PaginaUsuarios;
use App\Livewire\PaginaSprintAlterar;
use Illuminate\Support\Facades\Route;
use App\Livewire\PaginaProjetoCriarSprint;
use App\Livewire\PaginaProjetos;
use App\Livewire\PaginaProjetoSprints;
use App\Livewire\PaginaSprintBacklog;
use App\Livewire\PaginaSprintDetalhar;
use App\Livewire\PaginaSprintReport;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    // Route::post('register', [RegisteredUserController::class, 'store']);

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

Route::middleware('auth')->group(function () {
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

    Route::get('projetos', PaginaProjetos::class)->name('pagina-projetos');
    Route::get('usuarios', PaginaUsuarios::class)->middleware([AdminMiddleware::class])->name('pagina-usuarios');
    Route::get('projetos/{projetoId}/sprints', PaginaProjetoSprints::class)->name('pagina-projeto-sprints');
    Route::get('projetos/{projetoId}/sprints/criar', PaginaProjetoCriarSprint::class)->name('pagina-projeto-criar-sprint');
    Route::get('projetos/{projetoId}/sprints/{sprint}', PaginaSprintDetalhar::class)->name('pagina-sprint-detalhar');
    Route::get('projetos/{projetoId}/sprints/{sprint}/report', PaginaSprintReport::class)->name('pagina-sprint-report');
    Route::get('projetos/{projetoId}/sprints/{sprint}/backlog', PaginaSprintBacklog::class)->name('pagina-sprint-backlog');
    Route::get('projetos/{projetoId}/sprints/{sprint}/alterar', PaginaSprintAlterar::class)->name('pagina-sprint-alterar');
});
