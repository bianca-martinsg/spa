<?php

namespace App\Repositories;

use App\Product;

class ProductRepository
{
    // Método para listar todos os produtos
    public function all()
    {
        return Product::orderBy('created_at', 'desc')->get();
    }

    // Método para criar um novo produto
    public function create(array $data)
    {
        return Product::create($data); // Cria o produto e retorna
    }
}
