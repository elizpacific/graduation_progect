<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Repositories\ProductRepository;

class ProductsApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        return ProductResource::collection($this->productRepository->list());
    }

    public function getOne(int $id)
    {
        if (!$user = $this->productRepository->byId($id)) {
            abort(404);
        }
        return new ProductResource($user);
    }
}
