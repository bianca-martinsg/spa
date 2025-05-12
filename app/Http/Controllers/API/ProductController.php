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

    // List all products
    public function index()
    {
        return response()->json($this->repo->all());
    }

    // Create a new product
    public function store(StoreProductRequest $request)
    {
        // Validate the data with the StoreProductRequest (done automatically)
        $product = $this->repo->create($request->validated());

        return response()->json($product, 201); // Código 201 indica criação bem-sucedida
    }
}
