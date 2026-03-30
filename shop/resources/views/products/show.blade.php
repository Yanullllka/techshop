<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $product->name }} - TechShop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                </div>
                
                <div class="flex items-center space-x-4">
                    <a href="/cart" class="relative cart-link">
                        <svg class="w-6 h-6 text-gray-700 hover:text-purple-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span id="cart-count" class="absolute -top-2 -right-2 bg-purple-600 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">0</span>
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

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="grid md:grid-cols-2 gap-8 p-8">
                <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl h-96 flex items-center justify-center">
                    <svg class="w-48 h-48 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                
                <div>
                    <div class="mb-4">
                        <span class="text-sm text-gray-500">{{ $product->brand->name ?? 'Без бренда' }}</span>
                        <h1 class="text-3xl font-bold text-gray-800 mt-1">{{ $product->name }}</h1>
                    </div>
                    
                    <div class="mb-6">
                        <div class="text-3xl font-bold text-purple-600">
                            {{ number_format($product->price, 0, '', ' ') }} $
                        </div>
                        @if($product->old_price)
                            <div class="text-sm text-gray-400 line-through mt-1">
                                {{ number_format($product->old_price, 0, '', ' ') }} $
                            </div>
                        @endif
                    </div>
                    
                    <div class="mb-6">
                        <h3 class="font-semibold text-lg mb-2">Описание</h3>
                        <p class="text-gray-600 leading-relaxed">
                            {{ $product->description ?? 'Подробное описание товара будет добавлено позже.' }}
                        </p>
                    </div>
                    
                    <div class="mb-6">
                        <h3 class="font-semibold text-lg mb-2">Характеристики</h3>
                        <div class="space-y-2">
                            <div class="flex">
                                <span class="w-32 text-gray-600">Производитель:</span>
                                <span class="font-medium">{{ $product->brand->name ?? 'Не указан' }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-32 text-gray-600">Артикул:</span>
                                <span class="font-medium">{{ $product->sku ?? 'Не указан' }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-32 text-gray-600">Наличие:</span>
                                <span class="text-green-600 font-medium">{{ $product->stock > 0 ? 'В наличии' : 'Нет в наличии' }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Количество:</label>
                        <div class="flex items-center space-x-3">
                            <button type="button" id="decrease-qty" class="w-10 h-10 bg-gray-100 rounded-lg hover:bg-gray-200 transition text-xl font-bold">-</button>
                            <input type="number" id="quantity" value="1" min="1" max="99" 
                                   class="w-20 text-center border border-gray-300 rounded-lg py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
                            <button type="button" id="increase-qty" class="w-10 h-10 bg-gray-100 rounded-lg hover:bg-gray-200 transition text-xl font-bold">+</button>
                        </div>
                    </div>
                    
                    <div class="flex gap-4">
                        <button id="add-to-cart" 
                                data-product-id="{{ $product->id }}"
                                class="flex-1 bg-gradient-to-r from-purple-600 to-pink-600 text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg transition">
                            Добавить в корзину
                        </button>
                        <button class="bg-gray-100 text-gray-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-200 transition">
                            Избранное
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        @if(isset($relatedProducts) && $relatedProducts->count() > 0)
        <div class="mt-12">
            <h2 class="text-2xl font-bold mb-6">Похожие товары</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedProducts as $related)
                    <div class="bg-white rounded-xl shadow-lg p-4 hover:shadow-xl transition">
                        <div class="h-32 bg-gray-100 rounded-lg mb-3 flex items-center justify-center">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h3 class="font-semibold">
                            <a href="/products/{{ $related->id }}" class="hover:text-purple-600">{{ $related->name }}</a>
                        </h3>
                        <p class="text-purple-600 font-bold mt-2">{{ number_format($related->price, 0, '', ' ') }} $</p>
                    </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    <script>
        const quantityInput = document.getElementById('quantity');
        const decreaseBtn = document.getElementById('decrease-qty');
        const increaseBtn = document.getElementById('increase-qty');
        
        decreaseBtn.addEventListener('click', () => {
            let value = parseInt(quantityInput.value);
            if (value > 1) {
                quantityInput.value = value - 1;
            }
        });
        
        increaseBtn.addEventListener('click', () => {
            let value = parseInt(quantityInput.value);
            if (value < 99) {
                quantityInput.value = value + 1;
            }
        });
        
        quantityInput.addEventListener('change', () => {
            let value = parseInt(quantityInput.value);
            if (isNaN(value) || value < 1) {
                quantityInput.value = 1;
            } else if (value > 99) {
                quantityInput.value = 99;
            }
        });
        
        const addToCartBtn = document.getElementById('add-to-cart');
        
        addToCartBtn.addEventListener('click', function() {
            const productId = this.dataset.productId;
            const quantity = quantityInput.value;
            
            fetch('/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: quantity
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification(data.message, 'success');
                    document.getElementById('cart-count').textContent = data.cart_count;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Ошибка при добавлении товара', 'error');
            });
        });
        
        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.className = `fixed top-20 right-4 z-50 px-6 py-3 rounded-lg shadow-lg text-white ${
                type === 'success' ? 'bg-green-500' : 'bg-red-500'
            }`;
            notification.textContent = message;
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.remove();
            }, 3000);
        }
        const favoriteBtn = document.getElementById('add-to-favorite');
    if (favoriteBtn) {
        favoriteBtn.addEventListener('click', function() {
            const productId = this.dataset.productId;
            
            fetch('/wishlist/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ product_id: productId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification(data.message, 'success');
                    // Меняем цвет кнопки
                    favoriteBtn.classList.add('bg-red-500');
                    favoriteBtn.classList.remove('bg-gray-100');
                } else {
                    showNotification(data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Ошибка при добавлении в избранное', 'error');
            });
        });
    }
    
    function showNotification(message, type) {
        const notification = document.createElement('div');
        notification.className = `fixed top-20 right-4 z-50 px-6 py-3 rounded-lg shadow-lg text-white ${
            type === 'success' ? 'bg-green-500' : 'bg-red-500'
        }`;
        notification.textContent = message;
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.remove();
        }, 3000);
    }
    </script>
</body>
</html>