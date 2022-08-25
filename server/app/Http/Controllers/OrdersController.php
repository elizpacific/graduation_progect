<?php

namespace App\Http\Controllers;

use App\Repositories\OrderProductRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    public OrderRepository $orderRepository;
    public OrderProductRepository $orderProductRepository;
    public UserRepository $userRepository;

    public function __construct(
        OrderRepository $orderRepository,
        OrderProductRepository $orderProductRepository,
        UserRepository $userRepository
    ) {
        $this->orderRepository = $orderRepository;
        $this->orderProductRepository = $orderProductRepository;
        $this->userRepository = $userRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('orders.list', [
            'orders' => $this->orderRepository->list(),
            'users' => $this->userRepository->list(),
            'order_product' => $this->orderProductRepository->list(),
        ]);
    }

    public function getOne($id)
    {
        if (!$order = $this->orderRepository->byId($id)) {
            abort(404);
        }
        return view('orders.order', ['order' => $order]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(OrderRepository $orderRepository, UserRepository $userRepository, ProductRepository $productRepository)
    {
        return view('orders.create', ['orders' => $orderRepository->list(),'products' => $productRepository->list(), 'users' => $userRepository->list()]);
    }

    public function store(Request $request)
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
                'product_number' => ['required', 'max:255']]
        );

        $this->orderProductRepository->create($order, $request->product_id, $request->product_number);

        return redirect(route('orders.list', ['id' => $order->id]));
    }


    public function edit(Request $request,int $id): Redirector|Application|RedirectResponse
    {
        $data = $request->validate(
            ['delivery_address' => ['required', 'max:255'],
                'status' => ['required', 'max:255']]
        );

        //dd($data);

        if (!$order = $this->orderRepository->byId($id)) {
            abort(404);
        }

        $order = $this->orderRepository->update($order, $data);
        //dd($order);
        return redirect(route('orders.order', ['id' => $order->id]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function update(int $id): View|Factory|Application
    {
        if (!$order = $this->orderRepository->byId($id)) {
            abort(404);
        }

        return view('orders.update', ['order' => $order]);
    }

    public function orderStatistic(Request $request): Factory|View|Application
    {
        $from = $request->query('from');
        $to = $request->query('to');
        $orders = $this->orderRepository->getData($from, $to);
        $amountOfOrders = $orders->count();
        $totalPrice = 0;
        foreach($orders as $order) {
            foreach($order->orderProduct as $orderProduct) {
                $totalPrice += $orderProduct->product_quantity * $orderProduct->product->price;
            }
        }
        return view('orders.statistic', ['amountOfOrders' => $amountOfOrders,
            'totalPrice' => $totalPrice, 'dateFrom' => $from, 'dateTo' => $to]);
    }

}
