<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-purple-700">
            Заказы
        </h2>
    </x-slot>

    <div class="p-6 grid gap-4">

        @foreach($orders as $order)
            <div class="bg-white p-4 rounded-xl shadow flex justify-between items-center">

                <div>
                    <p class="font-bold">Заказ #{{ $order->id }}</p>
                    <p class="text-gray-600">Сумма: {{ $order->total_price }} $</p>
                </div>

                <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full">
                    {{ $order->status }}
                </span>

            </div>
        @endforeach

    </div>
</x-app-layout>