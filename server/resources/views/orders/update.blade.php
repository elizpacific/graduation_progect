<x-layout>
    <x-slot name="title">Update order</x-slot>

    <form action="{{ route('orders.edit', ['id' => $order->id]) }}" method="POST">
        @csrf
        <p>
            <label>Delivery address
                <input type="text" name="delivery_address" value="{{ $order->delivery_address }}">
            </label>
        </p>
        <p>
            <label>Status
                <input type="number" name="status" value="{{ $order->status }}">
            </label>
        </p>
        <button type="submit">Save</button>
    </form>
</x-layout>
