<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Configuracao;
use App\Models\Projeto;
use App\Models\Sprint;
use App\Models\User;
use App\Policies\ConfiguracaoPolicy;
use App\Policies\ProjetoPolicy;
use App\Policies\SprintPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Configuracao::class => ConfiguracaoPolicy::class,
        Projeto::class => ProjetoPolicy::class,
        Sprint::class => SprintPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
