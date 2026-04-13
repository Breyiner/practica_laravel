<?php
namespace App\Providers;

use App\Events\ProductoCreado;
use App\Listeners\EnviarNotificacionProductoCreado;
use App\Listeners\ActualizarInventario;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        ProductoCreado::class => [
            EnviarNotificacionProductoCreado::class,
            ActualizarInventario::class,
        ],
    ];
    
    public function boot(): void
    {
        //
    }
}