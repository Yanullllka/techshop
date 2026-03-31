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
                    <a href="/orders" class="text-gray-700 hover:text-purple-600 transition">Заказы</a>
                    <a href="/wishlist" class="text-gray-700 hover:text-purple-600 transition">Избранное</a>
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
        {{ $slot ?? '' }}
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