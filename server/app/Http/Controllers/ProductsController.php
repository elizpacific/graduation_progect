<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

class ProductsController extends Controller
{

    public ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('products.list', ['products' => $this->productRepository->list()]);
    }

    public function getOne($id)
    {
        if (!$product = $this->productRepository->byId($id)) {
            abort(404);
        }
        return view('products.product', ['product' => $product]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(ProductRepository $productRepository)
    {
        return view('products.create', ['products' => $productRepository->list()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate(
            ['title' => ['required', 'max:255'],
                'description' => ['required', 'max:255'],
                'price' => ['required', 'max:255']]
        );

        $product = $this->productRepository->create($data);
        return redirect(route('products.product', ['id' => $product->id]));
    }

//    public function show(int $id): Application|Factory|View
//    {
//        if (!$product = $this->productRepository->byId($id)) {
//            abort(404);
//        }
//
//        return view('products.product', ['product' => $product]);
//    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|RedirectResponse|Redirector
     */
    public function edit(Request $request,int $id): Redirector|RedirectResponse|Application
    {
        $data = $request->validate(
            ['title' => ['required', 'max:255'],
                'description' => ['required', 'max:255'],
                'price' => ['required', 'max:255']]
        );

        if (!$product = $this->productRepository->byId($id)) {
            abort(404);
        }

        $product = $this->productRepository->update($product, $data);
        return redirect(route('products.product', ['id' => $product->id]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function update(int $id)
    {
        if (!$product = $this->productRepository->byId($id)) {
            abort(404);
        }
        return view('products.update', ['product' => $product]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Application|Redirector|RedirectResponse
     */
    public function destroy(int $id): Application|RedirectResponse|Redirector
    {
        if (!$product = $this->productRepository->byId($id)) {
            abort(404);
        }
        $this->productRepository->delete($product);

        return redirect(route('products.list'));
    }
}
