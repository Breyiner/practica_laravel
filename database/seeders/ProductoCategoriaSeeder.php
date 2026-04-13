<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductoCategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = Categoria::select('id')->get()->pluck('id');

        // dd($categorias);


        Producto::whereNull('categoria_id')->get()->each(function ($producto) use ($categorias) {
            $producto->update([
                'categoria_id' => $categorias->random(),
            ]);
        });
    }
}
