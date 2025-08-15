<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; // ✅ Importação necessária
use App\Models\Categoria;
use App\Models\Plataforma;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator; // ✅ ADICIONE isto

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // ✅ Usa sua view de paginação (resources/views/components/pagination.blade.php)
        Paginator::defaultView('components.pagination');

        if (Schema::hasTable('categorias')) {
            View::share('categorias', Categoria::all());
        }

        if (Schema::hasTable('plataformas')) {
            View::share('plataformas', Plataforma::all());
        }
    }
}
