<?php

namespace App\Listeners;

use App\Events\ProductoCreado;
use App\Mail\NuevoProductoMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EnviarNotificacionProductoCreado
{

    /**
     * Handle the event.
     */
    public function handle(ProductoCreado $event): void
    {
        Log::info('Producto creado: ' . $event->producto->nombre);

        Mail::to("correo@example.com")->queue(
            new NuevoProductoMail($event->producto)
        );
    }
}
