<?php

namespace App\Http\Controllers;

use App\Http\Requests\Categoria\StoreCategoriaRequest;
use App\Models\Categoria;
use App\Services\CategoriaService;
use Illuminate\Http\Request;
use Nette\Utils\Json;

class CategoriaController extends Controller
{

    public function __construct(
        private CategoriaService $categoriaService
    ) {}

    public function index(Request $request)
    {
        $data = $this->categoriaService->getCategorias();

        return response()->json([
            'data' => $data
        ]);
    }

    public function show(Request $request, int $id)
    {
        $data = $this->categoriaService->getCategoria($id);

        return response()->json([
            'data' => $data
        ]);
    }

    public function store(StoreCategoriaRequest $request)
    {
        $dataValidated = $request->validated();

        $data = $this->categoriaService->createCategoria($dataValidated);

        return response()->json([
            'data' => $data
        ]);
    }
}
