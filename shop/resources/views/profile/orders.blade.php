<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мои заказы - TechShop</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-purple-50 to-pink-50">
    <nav class="bg-white/80 backdrop-blur-sm shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="/" class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-gradient-to-r from-purple-600 to-pink-600 rounded-lg"></div>
                    <span class="text-2xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">TechShop</span>
                </a>
                <div class="flex items-center space-x-8">
                    <a href="/products" class="text-gray-700 hover:text-purple-600 transition">Каталог</a>
                    <a href="/profile" class="text-purple-600 font-semibold">Личный кабинет</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-5xl mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Мои заказы</h1>
            <a href="{{ route('profile.index') }}" class="text-purple-600 hover:text-purple-700">← Назад</a>
        </div>
        
        @if($orders->count() > 0)
            <div class="space-y-4">
                @foreach($orders as $order)
                    <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <p class="font-bold text-lg">Заказ #{{ $order->id }}</p>
                                <p class="text-sm text-gray-500">{{ $order->created_at->format('d.m.Y H:i') }}</p>
                            </div>
                            <span class="px-4 py-2 rounded-full text-sm font-semibold
                                @if($order->status == 'pending') bg-yellow-100 text-yellow-700
                                @elseif($order->status == 'processing') bg-blue-100 text-blue-700
                                @elseif($order->status == 'completed') bg-green-100 text-green-700
                                @else bg-red-100 text-red-700
                                @endif">
                                @if($order->status == 'pending') В обработке
                                @elseif($order->status == 'processing') Выполняется
                                @elseif($order->status == 'completed') Выполнен
                                @else Отменен
                                @endif
                            </span>
                        </div>
                        <div class="border-t border-gray-200 pt-4">
                            <p class="text-gray-600">Сумма заказа: <span class="font-bold text-purple-600">{{ number_format($order->total_price, 0, '', ' ') }} ₽</span></p>
                            <p class="text-gray-600 mt-1">Способ оплаты: {{ $order->payment_status == 'paid' ? 'Оплачен' : 'Ожидает оплаты' }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-6">
                {{ $orders->links() }}
            </div>
        @else
            <div class="bg-white rounded-xl shadow-lg p-12 text-center">
                <div class="text-6xl mb-4">📦</div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">У вас пока нет заказов</h3>
                <p class="text-gray-600 mb-6">Перейдите в каталог и сделайте свой первый заказ</p>
                <a href="/products" class="bg-gradient-to-r from-purple-600 to-pink-600 text-white px-6 py-3 rounded-lg hover:shadow-lg transition">Перейти в каталог</a>
            </div>
        @endif
    </div>
</body>
</html>