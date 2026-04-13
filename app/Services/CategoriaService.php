<?php

namespace App\Services;

use App\Models\Categoria;

class CategoriaService
{

    public function getCategorias() {

        $categorias =  Categoria::with(['productos'])->get();

        return $categorias;

    }

    public function getCategoria(int $id) {
        $categoria = Categoria::find($id);

        return $categoria;
    }

    public function createCategoria(array $data) {

        $categoria = Categoria::create($data);

        return $categoria;

    }
}
