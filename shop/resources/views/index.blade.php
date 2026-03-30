<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>TechShop - Магазин техники</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: system-ui, -apple-system, 'Segoe UI', Roboto, sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-purple-50 to-pink-50">
    <nav class="bg-white/80 backdrop-blur-sm shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="/" class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-gradient-to-r from-purple-600 to-pink-600 rounded-lg"></div>
                    <span class="text-2xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                        TechShop
                    </span>
                </a>
                
                <div class="hidden md:flex items-center space-x-8">
                    <a href="/products" class="text-gray-700 hover:text-purple-600 transition">Каталог</a>
                    <a href="/categories" class="text-gray-700 hover:text-purple-600 transition">Категории</a>
                    <a href="/orders" class="text-gray-700 hover:text-purple-600 transition">Заказы</a>
                    <a href="/profile" class="bg-gradient-to-r from-purple-600 to-pink-600 text-white px-4 py-2 rounded-lg hover:shadow-lg transition font-medium">
                        Профиль
                    </a>
                </div>
                
                <div class="flex items-center space-x-4">
                    <a href="/cart" class="relative">
                        <svg class="w-6 h-6 text-gray-700 hover:text-purple-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span class="absolute -top-2 -right-2 bg-purple-600 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">0</span>
                    </a>
                    @guest
                        <a href="/login" class="text-gray-700 hover:text-purple-600 transition">Вход</a>
                        <a href="/register" class="bg-gradient-to-r from-purple-600 to-pink-600 text-white px-4 py-2 rounded-lg hover:shadow-lg transition">Регистрация</a>
                    @else
                        <div class="relative">
                            <button class="flex items-center space-x-2">
                                <div class="w-8 h-8 bg-gradient-to-r from-purple-600 to-pink-600 rounded-full flex items-center justify-center text-white font-bold">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <span class="text-gray-700">{{ Auth::user()->name }}</span>
                            </button>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-gradient-to-r from-purple-600 to-pink-600 rounded-2xl p-8 md:p-12 mb-12 text-white">
            <div class="max-w-2xl">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Новинки техники 2024</h1>
                <p class="text-lg mb-6 opacity-90">Скидки до 30% на последние модели смартфонов и ноутбуков</p>
                <a href="/products" class="inline-block bg-white text-purple-600 px-8 py-3 rounded-lg font-semibold hover:shadow-lg transition">
                    Перейти к покупкам →
                </a>
            </div>
        </div>

        <div class="mb-12">
            <h2 class="text-2xl md:text-3xl font-bold mb-6 flex items-center">
                <span class="bg-gradient-to-r from-purple-600 to-pink-600 w-1 h-8 rounded-full mr-3"></span>
                Новинки
                <span class="ml-3 text-sm text-gray-500 font-normal">Горячие новинки сезона</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($products->take(4) as $product)
                    <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden hover:scale-105">
                        <div class="h-48 bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center">
                            <svg class="w-24 h-24 text-gray-400 group-hover:scale-110 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg group-hover:text-purple-600 transition">
                                <a href="/products/{{ $product->id }}">{{ $product->name }}</a>
                            </h3>
                            <p class="text-gray-500 text-sm mb-3">{{ Str::limit($product->description ?? 'Описание товара', 50) }}</p>
                            <div class="flex justify-between items-center">
                                <span class="text-2xl font-bold text-purple-600">{{ number_format($product->price, 0, '', ' ') }} $</span>
                                <a href="/products/{{ $product->id }}" class="bg-purple-600 text-white p-2 rounded-lg hover:bg-purple-700 transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-4 text-center py-12">
                        <p class="text-gray-500">Товары не найдены</p>
                    </div>
                @endforelse
            </div>
        </div>

        @if($products->count() > 4)
        <div>
            <h2 class="text-2xl md:text-3xl font-bold mb-6 flex items-center">
                <span class="bg-gradient-to-r from-purple-600 to-pink-600 w-1 h-8 rounded-full mr-3"></span>
                Популярные товары
                <span class="ml-3 text-sm text-gray-500 font-normal">Лучший выбор покупателей</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($products->skip(4)->take(4) as $product)
                    <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden hover:scale-105">
                        <div class="h-48 bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center">
                            <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg hover:text-purple-600 transition">
                                <a href="/products/{{ $product->id }}">{{ $product->name }}</a>
                            </h3>
                            <p class="text-gray-500 text-sm mb-3">{{ Str::limit($product->description ?? 'Описание товара', 50) }}</p>
                            <div class="flex justify-between items-center">
                                <span class="text-2xl font-bold text-purple-600">{{ number_format($product->price, 0, '', ' ') }} $</span>
                                <a href="/products/{{ $product->id }}" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition text-sm">
                                    Купить
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    <footer class="bg-gray-900 text-white mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-2xl font-bold text-purple-400 mb-4">TechShop</h3>
                    <p class="text-gray-400">Лучшие технологии для вашего дома и офиса</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Информация</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-purple-400 transition">О нас</a></li>
                        <li><a href="#" class="hover:text-purple-400 transition">Доставка</a></li>
                        <li><a href="#" class="hover:text-purple-400 transition">Оплата</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Категории</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-purple-400 transition">Смартфоны</a></li>
                        <li><a href="#" class="hover:text-purple-400 transition">Ноутбуки</a></li>
                        <li><a href="#" class="hover:text-purple-400 transition">Аксессуары</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Контакты</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li> +375 (33) 340-90-73</li>
                        <li> yana@gmail.com</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2026 TechShop. Все права защищены.</p>
            </div>
        </div>
    </footer>
</body>
</html>