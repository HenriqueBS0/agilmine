<?php

namespace App\Providers;

use App\Contracts\FetchRedmineInterface;
use App\Http\Middleware\AdminMiddleware;
use App\Services\FetchRedmine;
use App\Services\ImportadorProjeto;
use App\Services\ProjetoService;
use App\Services\TarefaService;
use App\Services\UserService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(FetchRedmineInterface::class, function (Application $app) {
            return new FetchRedmine();
        });

        $this->app->singleton(ImportadorProjeto::class, function (Application $app) {
            $fetchRedmine = $app->make(FetchRedmineInterface::class);
            return new ImportadorProjeto($fetchRedmine);
        });

        $this->app->singleton(UserService::class, function (Application $app) {
            $fetchRedmine = $app->make(FetchRedmineInterface::class);
            return new UserService($fetchRedmine);
        });

        $this->app->singleton(ProjetoService::class, function (Application $app) {
            $fetchRedmine = $app->make(FetchRedmineInterface::class);
            $tarefaService = $app->make(TarefaService::class);
            $userService = $app->make(UserService::class);
            return new ProjetoService($fetchRedmine, $tarefaService, $userService);
        });

        $this->app->singleton(TarefaService::class, function (Application $app) {
            $fetchRedmine = $app->make(FetchRedmineInterface::class);
            return new TarefaService($fetchRedmine);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Livewire::addPersistentMiddleware([
            AdminMiddleware::class
        ]);
    }
}
