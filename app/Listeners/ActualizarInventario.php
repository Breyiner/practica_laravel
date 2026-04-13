<?php
namespace App\Listeners;

use App\Events\ProductoCreado;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class ActualizarInventario implements ShouldQueue
{
    public $queue = 'inventory';
    public $delay = 60; // Esperar 60 segundos
    
    public function handle(ProductoCreado $event): void
    {
        // Lógica para actualizar sistema de inventario externo
        Log::info('Actualizando inventario para: ' . $event->producto->nombre);
    }
    
    public function failed(ProductoCreado $event, $exception): void
    {
        Log::error('Error actualizando inventario: ' . $exception->getMessage());
    }
}