<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\OrderProduct;
//use Your Model

/**
 * Class OrderProductRepository.
 */
class OrderProductRepository
{
    public function list()
    {
        return OrderProduct::all();
    }

    public function create(Order $order, $productId, $productNumber)
    {
        $product = new ProductRepository();
        $product = $product->byId($productId);

        $orderProduct = new OrderProduct();
        $orderProduct->order_id = $order->id;
        $orderProduct->total_price = $productNumber * $product->price;
        $orderProduct->product_id = $productId;
        $orderProduct->product_number = $productNumber;
        $orderProduct->save();

        return $orderProduct;
    }
}
