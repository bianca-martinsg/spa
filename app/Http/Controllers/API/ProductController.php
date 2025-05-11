<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Repositories\ProductRepository;

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Repositories\ProductRepository;

class ProductController extends Controller
{
    protected $repo;

    public function __construct(ProductRepository $repo)
    {
        $this->repo = $repo;
    }

    // Método para listar os produtos
    public function index()
    {
        return response()->json($this->repo->all());
    }

    // Método para criar um novo produto
    public function store(StoreProductRequest $request) 
    {
        // Validar os dados com o StoreProductRequest (feito automaticamente)
        $product = $this->repo->create($request->validated());
        
        // Retornar o produto recém-criado
        return response()->json($product, 201); // Código 201 indica criação bem-sucedida
    }
}
