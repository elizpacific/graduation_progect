<?php

namespace App\Repositories;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class OrderRepository.
 */
class OrderRepository
{
    public function list()
    {
        return Order::all();
    }

    public function byId(int $id)
    {
        return Order::find($id);
    }

    public function create(string $deliveryAddress,int $userId): Order
    {
        $order = new Order;
        $order->delivery_address = $deliveryAddress;
        $order->status = 'new';
        $order->user_id = $userId;

        $order->save();

        return $order;
    }


    public function update(Order $order, array $data)
    {
        if (isset($data['delivery_address'])) {
            $order->delivery_address = $data['delivery_address'];
        }
        if (isset($data['status'])) {
            $order->status = $data['status'];
        }
        if (isset($data['price'])) {
            $order->price = $data['price'];
        }
        $order->save();
        return $order;
    }

    public function getData(?string $from, ?string $to)
    {
        return Order::whereBetween('created_at', [$from, $to])->get();
    }
}
