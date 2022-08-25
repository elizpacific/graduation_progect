<x-layout>
    <x-slot name="title">Order</x-slot>
    <div>
        {{ 'Delivery_address: ' . $order->delivery_address }} <br>
        {{ 'Status: ' . $order->status }} <br>
    </div>
</x-layout>
