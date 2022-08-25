<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Resources\UserResource;
use App\Repositories\OrderProductRepository;
use App\Repositories\OrderRepository;
use App\Repositories\UserRepository;
use App\Repositories\UserSessionTokenRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class OrdersApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public OrderRepository $orderRepository;
    public OrderProductRepository $orderProductRepository;

    public function __construct(OrderRepository $orderRepository, OrderProductRepository $orderProductRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->orderProductRepository = $orderProductRepository;
    }

    public function userOrders($id): AnonymousResourceCollection
    {
        $userRepository = new UserRepository();
        $user = $userRepository->byId($id);

        return OrderResource::collection($user->orders);
    }

    public function index(): AnonymousResourceCollection
    {
        return OrderResource::collection($this->orderRepository->list());
    }

    public function getOne(int $id)
    {
        if (!$order = $this->orderRepository->byId($id)) {
            abort(404);
        }
        return new OrderResource($order);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return OrderResource
     */
    public function create(Request $request)
    {
        $request->validate(
            ['delivery_address' => ['required', 'max:255'],
                'user_id' => ['required', 'exists:users,id']]
        );

        if (!$order = $this->orderRepository->create($request->delivery_address, $request->user_id)) {
            abort(404);
        }
        $request->validate(
            [
                'product_id' => ['required', 'exists:products,id'],
                'product_number' => ['required', 'max:255']
            ]
        );

        $this->orderProductRepository->create($order, $request->product_id, $request->product_number);

        return new OrderResource($order);
    }

    public function userIdByToken(string $token)
    {
        $userSessionTokenRepository = new UserSessionTokenRepository();
        $userToken = $userSessionTokenRepository->byToken($token);
        $user = $userToken->user;

        return new UserResource($user);
    }
}
