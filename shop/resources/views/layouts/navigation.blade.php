<nav class="bg-white shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <a href="/" class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-gradient-to-r from-purple-600 to-pink-600 rounded-lg"></div>
                    <span class="text-2xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                        TechShop
                    </span>
                </a>
            </div>

            <div class="hidden md:flex items-center space-x-8">
                <a href="/products" class="text-gray-700 hover:text-purple-600 transition font-medium">
                    Каталог
                </a>
                <a href="/categories" class="text-gray-700 hover:text-purple-600 transition font-medium">
                    Категории
                </a>
                <a href="/orders" class="text-gray-700 hover:text-purple-600 transition font-medium">
                    Заказы
                </a>
                <a href="/profile" class="bg-gradient-to-r from-purple-600 to-pink-600 text-white px-4 py-2 rounded-lg hover:shadow-lg transition font-medium">
                    👤 Профиль
                </a>
            </div>

            <div class="flex items-center space-x-4">
                <a href="/cart" class="relative">
                    <svg class="w-6 h-6 text-gray-700 hover:text-purple-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span id="cart-count" class="absolute -top-2 -right-2 bg-purple-600 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                        0
                    </span>
                </a>

                <div class="flex items-center space-x-4">
                    @guest
                        <a href="/login" class="text-gray-700 hover:text-purple-600 transition font-medium">
                            Вход
                        </a>
                        <a href="/register" class="bg-gradient-to-r from-purple-600 to-pink-600 text-white px-4 py-2 rounded-lg hover:shadow-lg transition">
                            Регистрация
                        </a>
                    @else
                        <div class="flex items-center space-x-2">
                            <div class="w-8 h-8 bg-gradient-to-r from-purple-600 to-pink-600 rounded-full flex items-center justify-center text-white font-bold">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <span class="text-gray-700 font-medium">{{ Auth::user()->name }}</span>
                        </div>
                    @endguest
                </div>
            </div>

            <div class="md:hidden flex items-center">
                <button id="mobile-menu-button" class="text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div id="mobile-menu" class="hidden md:hidden bg-white border-t">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="/products" class="block px-3 py-2 text-gray-700 hover:bg-purple-50 rounded-md">Каталог</a>
            <a href="/categories" class="block px-3 py-2 text-gray-700 hover:bg-purple-50 rounded-md">Категории</a>
            <a href="/orders" class="block px-3 py-2 text-gray-700 hover:bg-purple-50 rounded-md">Заказы</a>
           
            <a href="/profile" class="block px-3 py-2 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-md font-medium mt-2">
                👤 Профиль
            </a>
            @auth
                <form method="POST" action="/logout" class="mt-2">
                    @csrf
                    <button type="submit" class="w-full text-left px-3 py-2 text-red-600 hover:bg-red-50 rounded-md">
                        🚪 Выйти
                    </button>
                </form>
            @else
                <a href="/login" class="block px-3 py-2 text-gray-700 hover:bg-purple-50 rounded-md">Вход</a>
                <a href="/register" class="block px-3 py-2 text-gray-700 hover:bg-purple-50 rounded-md">Регистрация</a>
            @endauth
        </div>
    </div>
</nav>

<script>
    const mobileButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    
    if (mobileButton && mobileMenu) {
        mobileButton.addEventListener('click', () => {
            if (mobileMenu.classList.contains('hidden')) {
                mobileMenu.classList.remove('hidden');
            } else {
                mobileMenu.classList.add('hidden');
            }
        });
    }
</script>