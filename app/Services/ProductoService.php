<?php

namespace App\Services;

use App\Models\Producto;

class ProductoService
{

    public function getProductos() {

        $productos =  Producto::all()->makeHidden(['nombre']);

        return $productos;

    }

    public function getProducto(int $id) {
        $producto = Producto::find($id);

        return $producto;
    }

    public function createProducto(array $data) {

        $producto = Producto::create($data);

        return $producto;

    }
}
