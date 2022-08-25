<?php

namespace App\Repositories;

use App\Models\Product;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class ProductRepository.
 */
class ProductRepository
{
    public function list()
    {
        return Product::all();
    }

    public function byId(int $id)
    {
        return Product::find($id);
    }

    public function create(array $data)
    {
        $product = new Product;
        $product->title = $data['title'];
        $product->description = $data['description'];
        $product->price = $data['price'];
        $product->save();

        return $product;
    }

    /**
     * @param Product $admin
     * @param array $data
     * @return Product
     */
    public function update(Product $product, array $data)
    {
        if (isset($data['title'])) {
            $product->title = $data['title'];
        }
        if (isset($data['description'])) {
            $product->description = $data['description'];
        }
        if (isset($data['price'])) {
            $product->price = $data['price'];
        }
        $product->save();
        return $product;
    }

    public function delete(Product $product)
    {
        $product->delete();
    }
}
