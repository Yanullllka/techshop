<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>TechShop - {{ config('app.name', 'Laravel') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        [x-cloak] { display: none !important; }
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gradient-to-br from-gray-50 to-gray-100">
    <div class="min-h-screen">
        @include('layouts.navigation')
        
        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white/80 backdrop-blur-sm shadow-sm sticky top-0 z-10 border-b border-gray-200">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
        
        <!-- Footer -->
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
                            <li><a href="#" class="hover:text-purple-400 transition">Контакты</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-semibold mb-4">Категории</h4>
                        <ul class="space-y-2 text-gray-400">
                            <li><a href="#" class="hover:text-purple-400 transition">Смартфоны</a></li>
                            <li><a href="#" class="hover:text-purple-400 transition">Ноутбуки</a></li>
                            <li><a href="#" class="hover:text-purple-400 transition">Планшеты</a></li>
                            <li><a href="#" class="hover:text-purple-400 transition">Аксессуары</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-semibold mb-4">Контакты</h4>
                        <ul class="space-y-2 text-gray-400">
                            <li>📞 +7 (999) 123-45-67</li>
                            <li>✉️ info@techshop.ru</li>
                            <li>📍 г. Москва, ул. Технологическая, 1</li>
                        </ul>
                    </div>
                </div>
                <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                    <p>&copy; 2024 TechShop. Все права защищены.</p>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>