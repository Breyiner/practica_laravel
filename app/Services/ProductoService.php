<?php

namespace App\Services;

use App\Events\ProductoCreado;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductoService
{

    public function getProductos()
    {

        $productos =  Producto::with(['categoria'])->get();

        return $productos;
    }

    public function getProducto(int $id)
    {
        $producto = Producto::find($id);

        return $producto;
    }

    public function createProducto(array $data, $request)
    {
        DB::beginTransaction();
        try {
            if ($request->hasFile('imagen')) {
                $path = Storage::disk('public')->putFile('productos/imagenes', $request->file('imagen'));
            }

            $producto = Producto::create($data);

            $producto->imagenes()->create([
                'ruta' => $path
            ]);

            DB::commit();

            event(new ProductoCreado($producto));
            
            return $producto->load('imagenes');

        } catch (\Exception $e) {
            DB::rollback();
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
            return $e->getMessage();
        }
    }
}
