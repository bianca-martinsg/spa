<?php

namespace App\Repositories;

use App\Product;

class ProductRepository
{
    // List all products
    public function all()
    {
        return Product::orderBy('created_at', 'desc')->get();
    }

    // Create a new product
    public function create(array $data)
    {
        return Product::create($data); // Cria o produto e retorna
    }

    // Update a product
    public function update(int $id, array $data)
    {
        return Product::find($id)->update($data);
    }

    // Delete a product
    public function delete(int $id)
    {
        return Product::find($id)->delete();
    }
}
