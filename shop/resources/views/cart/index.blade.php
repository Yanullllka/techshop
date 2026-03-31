<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Корзина - TechShop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
        .modal-animation {
            animation: fadeIn 0.3s ease-out;
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
                    <a href="/products" class="text-gray-700 hover:text-purple-600 transition">Каталог</a>
                    <a href="/categories" class="text-gray-700 hover:text-purple-600 transition">Категории</a>
                    <a href="/orders" class="text-gray-700 hover:text-purple-600 transition">Заказы</a>
                    <a href="/profile" class="text-purple-600 font-semibold">Личный кабинет</a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="/cart" class="relative">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span id="cart-count" class="absolute -top-2 -right-2 bg-purple-600 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">{{ $cart->count ?? 0 }}</span>
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
                                <button type="submit" class="bg-red-500 text-white px-3 py-1.5 rounded-lg hover:bg-red-600 transition text-sm">
                                    Выйти
                                </button>
                            </form>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8 bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">Корзина</h1>
        
        @if($cart->items->count() > 0)
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden" id="cart-container">
                @foreach($cart->items as $item)
                    <div class="border-b border-gray-200 p-6 hover:bg-gray-50 transition cart-item" data-id="{{ $item->id }}">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <h3 class="font-bold text-lg text-gray-800">{{ $item->product->name }}</h3>
                                <p class="text-gray-600">${{ number_format($item->price, 0, '', ' ') }}</p>
                            </div>
                            <div class="flex items-center space-x-4">
                                <div class="flex items-center space-x-2">
                                    <button class="update-qty w-8 h-8 bg-gray-100 rounded-lg hover:bg-gray-200 transition" data-id="{{ $item->id }}" data-change="-1">-</button>
                                    <span class="w-12 text-center quantity-display">{{ $item->quantity }}</span>
                                    <button class="update-qty w-8 h-8 bg-gray-100 rounded-lg hover:bg-gray-200 transition" data-id="{{ $item->id }}" data-change="1">+</button>
                                </div>
                                <div class="w-32 text-right font-bold text-purple-600 item-total">
                                    ${{ number_format($item->price * $item->quantity, 0, '', ' ') }}
                                </div>
                                <button class="remove-item text-red-500 hover:text-red-700 transition" data-id="{{ $item->id }}">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
                
                <div class="bg-gray-50 p-6">
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-lg font-semibold">Итого:</span>
                        <span id="cart-total" class="text-2xl font-bold text-purple-600">${{ number_format($cart->total, 0, '', ' ') }}</span>
                    </div>
                    <div class="flex gap-4">
                        <button id="clear-cart" class="bg-red-500 text-white px-6 py-3 rounded-lg hover:bg-red-600 transition">Очистить корзину</button>
                        <button id="checkout-btn" class="flex-1 bg-gradient-to-r from-purple-600 to-pink-600 text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg transition">
                            Оформить заказ
                        </button>
                    </div>
                </div>
            </div>
        @else
            <div class="bg-white rounded-2xl shadow-xl p-12 text-center">
                <div class="text-6xl mb-4">🛒</div>
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Корзина пуста</h2>
                <p class="text-gray-600 mb-6">Добавьте товары в корзину, чтобы продолжить покупки</p>
                <a href="/products" class="bg-gradient-to-r from-purple-600 to-pink-600 text-white px-6 py-3 rounded-lg hover:shadow-lg transition">Перейти в каталог</a>
            </div>
        @endif
    </div>

    <div id="checkout-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl p-8 max-w-md w-full mx-4 modal-animation">
            <div class="text-center">
                <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-2">Заказ оформлен!</h3>
                <p class="text-gray-600 mb-4" id="modal-message">Ваш заказ передан в доставку! Менеджер свяжется с вами в ближайшее время.</p>
                <div class="flex gap-3 mt-6">
                    <button id="close-modal" class="flex-1 bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700 transition">
                        Продолжить покупки
                    </button>
                    <a href="/orders" class="flex-1 bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 transition text-center">
                        Мои заказы
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
        
        document.querySelectorAll('.update-qty').forEach(btn => {
            btn.addEventListener('click', function() {
                const itemId = this.dataset.id;
                const change = parseInt(this.dataset.change);
                const quantitySpan = this.parentElement.querySelector('.quantity-display');
                let newQty = parseInt(quantitySpan.textContent) + change;
                
                if (newQty < 1) newQty = 1;
                if (newQty > 99) newQty = 99;
                
                fetch(`/cart/update/${itemId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ quantity: newQty })
                }).then(() => location.reload());
            });
        });
        
        document.querySelectorAll('.remove-item').forEach(btn => {
            btn.addEventListener('click', function() {
                const itemId = this.dataset.id;
                if (confirm('Удалить товар из корзины?')) {
                    fetch(`/cart/remove/${itemId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        }
                    }).then(() => location.reload());
                }
            });
        });
        
        const clearCartBtn = document.getElementById('clear-cart');
        if (clearCartBtn) {
            clearCartBtn.addEventListener('click', function() {
                if (confirm('Очистить всю корзину?')) {
                    fetch('/cart/clear', {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        }
                    }).then(() => location.reload());
                }
            });
        }
        
        const checkoutBtn = document.getElementById('checkout-btn');
        const modal = document.getElementById('checkout-modal');
        const closeModal = document.getElementById('close-modal');
        
        if (checkoutBtn) {
            checkoutBtn.addEventListener('click', function() {
                const originalText = this.innerHTML;
                this.innerHTML = 'Оформление...';
                this.disabled = true;
                
                fetch('/cart/checkout', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({})
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Ошибка сервера: ' + response.status);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        const modalMessage = document.getElementById('modal-message');
                        modalMessage.textContent = data.message;
                        modal.classList.remove('hidden');
                        modal.classList.add('flex');
                        
                        const cartCount = document.getElementById('cart-count');
                        if (cartCount) {
                            cartCount.textContent = '0';
                        }
                    } else {
                        alert(data.message || 'Ошибка при оформлении заказа');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Ошибка при оформлении заказа: ' + error.message);
                })
                .finally(() => {
                    this.innerHTML = originalText;
                    this.disabled = false;
                });
            });
        }
        
        if (closeModal) {
            closeModal.addEventListener('click', function() {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                location.reload();
            });
        }
        
        if (modal) {
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                    location.reload();
                }
            });
        }
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    
    function checkAuth() {
        return new Promise((resolve) => {
            fetch('/check-auth')
                .then(response => response.json())
                .then(data => resolve(data.authenticated))
                .catch(() => resolve(false));
        });
    }
    
    function redirectToLogin() {
        window.location.href = '/login';
    }
    
    // Оформление заказа с проверкой авторизации
    const checkoutBtn = document.getElementById('checkout-btn');
    if (checkoutBtn) {
        checkoutBtn.addEventListener('click', async function() {
            // Проверяем авторизацию
            const isAuth = await checkAuth();
            if (!isAuth) {
                showNotification('Для оформления заказа нужно войти в аккаунт', 'error');
                setTimeout(() => redirectToLogin(), 2000);
                return;
            }
            
            const originalText = this.innerHTML;
            this.innerHTML = '⏳ Оформление...';
            this.disabled = true;
            
            fetch('/cart/checkout', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({})
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const modalMessage = document.getElementById('modal-message');
                    modalMessage.textContent = data.message;
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                    
                    const cartCount = document.getElementById('cart-count');
                    if (cartCount) cartCount.textContent = '0';
                } else {
                    alert(data.message || 'Ошибка при оформлении заказа');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Ошибка при оформлении заказа');
            })
            .finally(() => {
                this.innerHTML = originalText;
                this.disabled = false;
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
        setTimeout(() => notification.remove(), 3000);
    }
    </script>
</body>
</html>