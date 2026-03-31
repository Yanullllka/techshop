<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-purple-700">
                Мои заказы
            </h2>
            <a href="/products" class="bg-gradient-to-r from-purple-600 to-pink-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:shadow-lg transition">
                Перейти в каталог
            </a>
        </div>
    </x-slot>

    <div class="p-8">
        @if($orders->count() > 0)
            <div class="space-y-6">
                @foreach($orders as $order)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                            <div class="flex justify-between items-center">
                                <div>
                                    <span class="text-sm text-gray-500">Заказ от {{ $order->created_at->format('d.m.Y H:i') }}</span>
                                    <h3 class="font-bold text-lg">Заказ #{{ $order->id }}</h3>
                                </div>
                                <div class="text-right">
                                    <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold
                                        @if($order->status == 'new') bg-yellow-100 text-yellow-700
                                        @elseif($order->status == 'processing') bg-blue-100 text-blue-700
                                        @elseif($order->status == 'shipped') bg-purple-100 text-purple-700
                                        @elseif($order->status == 'delivered') bg-green-100 text-green-700
                                        @else bg-red-100 text-red-700
                                        @endif">
                                        @if($order->status == 'new') В обработке
                                        @elseif($order->status == 'processing') Выполняется
                                        @elseif($order->status == 'shipped') Передан в доставку
                                        @elseif($order->status == 'delivered') Доставлен
                                        @else Отменен
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-6">
                            @foreach($order->items as $item)
                                <div class="flex justify-between items-center py-3 border-b border-gray-100 last:border-0">
                                    <div class="flex-1">
                                        <p class="font-medium text-gray-800">{{ $item->product->name }}</p>
                                        <p class="text-sm text-gray-500">Количество: {{ $item->quantity }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-bold text-purple-600">${{ number_format($item->price * $item->quantity, 0, '', ' ') }}</p>
                                        <p class="text-sm text-gray-500">${{ number_format($item->price, 0, '', ' ') }} за шт.</p>
                                    </div>
                                </div>
                            @endforeach
                            
                            <div class="mt-4 pt-4 border-t border-gray-200">
                                <div class="flex justify-between items-center">
                                    <span class="font-semibold text-lg">Итого:</span>
                                    <span class="text-2xl font-bold text-purple-600">${{ number_format($order->total_price, 0, '', ' ') }}</span>
                                </div>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">Способ оплаты: {{ $order->payment_method == 'cash_on_delivery' ? 'Наличными при получении' : $order->payment_method }}</p>
                                    <p class="text-sm text-gray-500">Адрес доставки: {{ $order->address }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="mt-8">
                {{ $orders->links() }}
            </div>
        @else
            <div class="bg-white rounded-xl shadow-lg p-12 text-center">
                <h3 class="text-xl font-semibold text-gray-800 mb-2">У вас пока нет заказов</h3>
                <p class="text-gray-600 mb-6">Перейдите в каталог и сделайте свой первый заказ</p>
                <a href="/products" class="bg-gradient-to-r from-purple-600 to-pink-600 text-white px-6 py-3 rounded-lg hover:shadow-lg transition">
                    Перейти в каталог
                </a>
            </div>
        @endif
    </div>
</x-app-layout>