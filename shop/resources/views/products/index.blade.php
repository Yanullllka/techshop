<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Каталог - TechShop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        [x-cloak] { display: none !important; }
        .transition-all {
            transition: all 0.3s ease;
        }
    </style>
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
                    <a href="/products" class="text-purple-600 font-semibold">Каталог</a>
                    <a href="/categories" class="text-gray-700 hover:text-purple-600 transition">Категории</a>
                    <a href="/orders" class="text-gray-700 hover:text-purple-600 transition">Заказы</a>
                    <a href="/profile" class="bg-gradient-to-r from-purple-600 to-pink-600 text-white px-4 py-2 rounded-lg hover:shadow-lg transition">👤 Профиль</a>
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
        <div class="mb-8">
            <h1 class="text-4xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                Каталог товаров
            </h1>
            <p class="text-gray-600 mt-2">Найдено товаров: {{ $products->total() }}</p>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
            <form method="GET" action="{{ route('products.index') }}" id="filter-form">
               
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Поиск товаров</label>
                    <div class="relative">
                        <input type="text" name="search" value="{{ request('search') }}" 
                               placeholder="Введите название товара..."
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 pl-10">
                        <svg class="absolute left-3 top-3.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Бренды</label>
                        <div class="space-y-2 max-h-40 overflow-y-auto">
                            @foreach($brands as $brand)
                                <label class="flex items-center">
                                    <input type="checkbox" name="brand[]" value="{{ $brand->id }}" 
                                           class="rounded border-gray-300 text-purple-600 focus:ring-purple-500 brand-checkbox"
                                           {{ in_array($brand->id, (array)request('brand', [])) ? 'checked' : '' }}>
                                    <span class="ml-2 text-gray-700">{{ $brand->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Категории</label>
                        <select name="category" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                            <option value="">Все категории</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Цена -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Цена ($)</label>
                        <div class="flex gap-2">
                            <input type="number" name="price_min" value="{{ request('price_min') }}" 
                                   placeholder="от" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                            <input type="number" name="price_max" value="{{ request('price_max') }}" 
                                   placeholder="до" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2"> Сортировка</label>
                        <select name="sort" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Сначала новинки</option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Цена: по возрастанию</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Цена: по убыванию</option>
                            <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Название: А-Я</option>
                            <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Название: Я-А</option>
                        </select>
                    </div>
                </div>

                <div class="flex justify-between mt-6">
                    <button type="submit" class="bg-gradient-to-r from-purple-600 to-pink-600 text-white px-6 py-2 rounded-lg hover:shadow-lg transition">
                        Применить фильтры
                    </button>
                    <a href="{{ route('products.index') }}" class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 transition">
                        Сбросить все
                    </a>
                </div>
            </form>
        </div>

        @if($products->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($products as $product)
                    <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden hover:scale-105">
                        <div class="relative h-48 bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center">
                            <svg class="w-24 h-24 text-gray-400 group-hover:scale-110 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            @if($product->created_at > now()->subDays(7))
                                <div class="absolute top-2 right-2 bg-green-500 text-white text-xs px-2 py-1 rounded-full">NEW</div>
                            @endif
                        </div>
                        <div class="p-4">
                            <div class="mb-2">
                                <span class="text-xs text-gray-500">{{ $product->brand->name ?? 'Без бренда' }}</span>
                                <h3 class="font-bold text-lg text-gray-800 group-hover:text-purple-600 transition line-clamp-1">
                                    <a href="/products/{{ $product->id }}">{{ $product->name }}</a>
                                </h3>
                            </div>
                            <p class="text-gray-600 text-sm mb-3 line-clamp-2">
                                {{ Str::limit($product->description ?? 'Отличный товар высокого качества', 60) }}
                            </p>
                            <div class="flex items-center justify-between mt-4">
                                <div>
                                    <span class="text-2xl font-bold text-purple-600">${{ number_format($product->price, 0, '', ' ') }}</span>
                                    @if($product->old_price)
                                        <span class="text-xs text-gray-400 line-through ml-2">${{ number_format($product->old_price, 0, '', ' ') }}</span>
                                    @endif
                                </div>
                                <a href="/products/{{ $product->id }}" 
                                   class="bg-gradient-to-r from-purple-600 to-pink-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:shadow-lg transition">
                                    Купить
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $products->links() }}
            </div>
        @else
            <div class="bg-white rounded-2xl shadow-xl p-12 text-center">
                <div class="text-6xl mb-4">🔍</div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Товары не найдены</h3>
                <p class="text-gray-600 mb-6">Попробуйте изменить параметры поиска или сбросить фильтры</p>
                <a href="{{ route('products.index') }}" class="bg-gradient-to-r from-purple-600 to-pink-600 text-white px-6 py-3 rounded-lg hover:shadow-lg transition">
                    Сбросить фильтры
                </a>
            </div>
        @endif
    </div>

    <script>
        const checkboxes = document.querySelectorAll('.brand-checkbox');
        const selects = document.querySelectorAll('select');
        const form = document.getElementById('filter-form');
        
        if (form) {
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', () => {
                    form.submit();
                });
            });
            
            selects.forEach(select => {
                select.addEventListener('change', () => {
                    form.submit();
                });
            });
        }
    </script>
    <style>
    .pagination {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
        flex-wrap: wrap;
    }
    
    .pagination .page-item {
        list-style: none;
    }
    
    .pagination .page-link {
        display: block;
        padding: 0.5rem 1rem;
        background: white;
        color: #7c3aed;
        border-radius: 0.5rem;
        text-decoration: none;
        transition: all 0.3s;
    }
    
    .pagination .page-link:hover {
        background: #7c3aed;
        color: white;
        transform: scale(1.05);
    }
    
    .pagination .active .page-link {
        background: linear-gradient(to right, #7c3aed, #ec489a);
        color: white;
    }
    
    .pagination .disabled .page-link {
        opacity: 0.5;
        cursor: not-allowed;
    }
    
    .line-clamp-1 {
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
</body>
</html>