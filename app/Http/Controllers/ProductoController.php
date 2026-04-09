<?php

namespace App\Http\Controllers;

use App\Http\Requests\Producto\StoreProductoRequest;
use App\Models\Producto;
use App\Services\ProductoService;
use Illuminate\Http\Request;
use Nette\Utils\Json;

class ProductoController extends Controller
{

    public function __construct(
        private ProductoService $productoService
    ) {}

    public function index(Request $request)
    {
        $data = $this->productoService->getProductos();

        return response()->json([
            'data' => $data
        ]);
    }

    public function show(Request $request, int $id)
    {
        $data = $this->productoService->getProducto($id);

        return response()->json([
            'data' => $data
        ]);
    }

    public function store(StoreProductoRequest $request)
    {
        $dataValidated = $request->validated();

        $data = $this->productoService->createProducto($dataValidated);

        return response()->json([
            'data' => $data
        ]);
    }
}
