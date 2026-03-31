<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Личный кабинет - TechShop</title>
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
                <div class="hidden md:flex items-center space-x-8">
                    <a href="/products" class="text-gray-700 hover:text-purple-600 transition">Каталог</a>
                    <a href="/orders" class="text-gray-700 hover:text-purple-600 transition">Заказы</a>
                    <a href="/wishlist" class="text-gray-700 hover:text-purple-600 transition">Избранное</a>
                    <a href="/profile" class="text-purple-600 font-semibold">Личный кабинет</a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="/cart" class="relative">
                        <svg class="w-6 h-6 text-gray-700 hover:text-purple-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span id="cart-count" class="absolute -top-2 -right-2 bg-purple-600 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">0</span>
                    </a>
                    @guest
                        <a href="/login" class="text-gray-700 hover:text-purple-600 transition">Вход</a>
                        <a href="/register" class="bg-gradient-to-r from-purple-600 to-pink-600 text-white px-4 py-2 rounded-lg">Регистрация</a>
                    @else
                        <div class="flex items-center space-x-3">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 bg-gradient-to-r from-purple-600 to-pink-600 rounded-full flex items-center justify-center text-white font-bold">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <span class="text-gray-700">{{ Auth::user()->name }}</span>
                            </div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="bg-red-500 text-white px-3 py-1.5 rounded-lg hover:bg-red-600 transition text-sm">Выйти</button>
                            </form>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-gradient-to-r from-purple-600 to-pink-600 rounded-2xl p-8 mb-8 text-white">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center">
                        @if($user->avatar)
                            <img src="{{ Storage::url('avatars/' . $user->avatar) }}" class="w-20 h-20 rounded-full object-cover">
                        @else
                            <span class="text-4xl">{{ substr($user->name, 0, 1) }}</span>
                        @endif
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold">Добро пожаловать, {{ $user->name }}!</h1>
                        <p class="text-white/80 mt-1">{{ $user->email }}</p>
                    </div>
                </div>
                <!-- ССЫЛКА НА КАТАЛОГ -->
                <a href="/products" class="bg-white text-purple-600 px-6 py-3 rounded-lg font-semibold hover:shadow-lg transition">
                    Перейти в каталог
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Всего заказов</p>
                        <p class="text-3xl font-bold text-purple-600">{{ $user->orders->count() }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Сумма заказов</p>
                        <p class="text-3xl font-bold text-purple-600">{{ number_format($user->orders->sum('total_price'), 0, '', ' ') }} $</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Дата регистрации</p>
                        <p class="text-xl font-semibold text-gray-800">{{ $user->created_at->format('d.m.Y') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="md:col-span-1">
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="font-bold text-lg">Меню</h3>
                    </div>
                    <div class="p-4 space-y-2">
                        <a href="{{ route('profile.index') }}" class="block px-4 py-2 bg-purple-50 text-purple-600 rounded-lg font-medium">
                            Общая информация
                        </a>
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-gray-50 rounded-lg transition">
                            Редактировать профиль
                        </a>
                        <a href="{{ route('profile.orders') }}" class="block px-4 py-2 hover:bg-gray-50 rounded-lg transition">
                            Мои заказы
                        </a>
                        <hr class="my-2">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50 rounded-lg transition">
                                Выйти из аккаунта
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="md:col-span-2">
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-bold text-xl">Информация о пользователе</h3>
                        <a href="{{ route('profile.edit') }}" class="text-purple-600 hover:text-purple-700 text-sm">
                            Редактировать
                        </a>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Имя</label>
                            <p class="text-lg font-semibold text-gray-800">{{ $user->name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Email</label>
                            <p class="text-lg font-semibold text-gray-800">{{ $user->email }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Телефон</label>
                            <p class="text-lg font-semibold text-gray-800">{{ $user->phone ?? 'Не указан' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Адрес доставки</label>
                            <p class="text-lg font-semibold text-gray-800">{{ $user->address ?? 'Не указан' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>