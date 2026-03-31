<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $product->name }} - TechShop</title>
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
                    <span class="text-2xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">TechShop</span>
                </a>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="/products" class="text-gray-700 hover:text-purple-600 transition">Каталог</a>
                    <a href="/categories" class="text-gray-700 hover:text-purple-600 transition">Категории</a>
                    <a href="/orders" class="text-gray-700 hover:text-purple-600 transition">Заказы</a>
                    <a href="/wishlist" class="text-gray-700 hover:text-purple-600 transition">Избранное</a>
                    <a href="/profile" class="bg-gradient-to-r from-purple-600 to-pink-600 text-white px-4 py-2 rounded-lg hover:shadow-lg transition">Профиль</a>
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
                        <a href="/register" class="bg-gradient-to-r from-purple-600 to-pink-600 text-white px-4 py-2 rounded-lg hover:shadow-lg transition">Регистрация</a>
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
                        <div class="text-3xl font-bold text-purple-600">${{ number_format($product->price, 0, '', ' ') }}</div>
                    </div>
                    <div class="mb-6">
                        <h3 class="font-semibold text-lg mb-2">Описание</h3>
                        <p class="text-gray-600 leading-relaxed">{{ $product->description ?? 'Подробное описание товара будет добавлено позже.' }}</p>
                    </div>
                    <div class="flex gap-4">
                        @auth
                            <button id="add-to-cart" data-product-id="{{ $product->id }}" class="flex-1 bg-gradient-to-r from-purple-600 to-pink-600 text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg transition">Добавить в корзину</button>
                            <button id="add-to-favorite" data-product-id="{{ $product->id }}" class="bg-gray-100 text-gray-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-200 transition">Избранное</button>
                        @else
                            <a href="{{ route('login') }}" class="flex-1 bg-gradient-to-r from-purple-600 to-pink-600 text-white px-6 py-3 rounded-lg font-semibold text-center">Войдите, чтобы купить</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>

        <!-- Отзывы -->
        <div class="mt-12">
            <h2 class="text-2xl font-bold mb-6">Отзывы</h2>
            
            @auth
                <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                    <h3 class="font-semibold text-lg mb-4">Оставить отзыв</h3>
                    <form id="review-form" data-product-id="{{ $product->id }}">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Оценка</label>
                            <div class="flex gap-2">
                                <span class="cursor-pointer text-2xl rating-star" data-value="1">☆</span>
                                <span class="cursor-pointer text-2xl rating-star" data-value="2">☆</span>
                                <span class="cursor-pointer text-2xl rating-star" data-value="3">☆</span>
                                <span class="cursor-pointer text-2xl rating-star" data-value="4">☆</span>
                                <span class="cursor-pointer text-2xl rating-star" data-value="5">☆</span>
                            </div>
                            <input type="hidden" id="rating-value" value="5">
                        </div>
                        <div class="mb-4">
                            <textarea id="comment" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" placeholder="Поделитесь своим мнением о товаре..."></textarea>
                        </div>
                        <button type="submit" class="bg-gradient-to-r from-purple-600 to-pink-600 text-white px-6 py-2 rounded-lg hover:shadow-lg transition">Отправить отзыв</button>
                    </form>
                </div>
            @else
                <div class="bg-white rounded-xl shadow-lg p-6 mb-8 text-center">
                    <p class="text-gray-600">Чтобы оставить отзыв, <a href="{{ route('login') }}" class="text-purple-600 hover:text-purple-700">войдите в аккаунт</a></p>
                </div>
            @endauth
            
            <div id="reviews-list" class="space-y-4">
                @forelse($product->reviews()->with('user')->latest()->get() as $review)
                    <div class="bg-white rounded-xl shadow-lg p-6" id="review-{{ $review->id }}">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <span class="font-semibold text-gray-800">{{ $review->user->name }}</span>
                                <span class="text-sm text-gray-500 ml-3">{{ $review->created_at->format('d.m.Y H:i') }}</span>
                            </div>
                            @auth
                                @if(Auth::id() === $review->user_id)
                                    <button class="delete-review text-red-500 hover:text-red-700 text-sm" data-id="{{ $review->id }}">Удалить</button>
                                @endif
                            @endauth
                        </div>
                        <div class="mb-2 flex gap-1">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $review->rating)
                                    <span class="text-yellow-500 text-lg">★</span>
                                @else
                                    <span class="text-gray-300 text-lg">☆</span>
                                @endif
                            @endfor
                        </div>
                        <p class="text-gray-700">{{ $review->comment }}</p>
                    </div>
                @empty
                    <div class="bg-white rounded-xl shadow-lg p-6 text-center">
                        <p class="text-gray-500">Пока нет отзывов. Будьте первым!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
        
        // Рейтинг
        const ratingStars = document.querySelectorAll('.rating-star');
        const ratingInput = document.getElementById('rating-value');
        if (ratingStars.length > 0) {
            ratingStars.forEach(star => {
                star.addEventListener('click', function() {
                    const value = parseInt(this.dataset.value);
                    ratingInput.value = value;
                    ratingStars.forEach((s, index) => {
                        if (index < value) {
                            s.innerHTML = '★';
                            s.classList.add('text-yellow-500');
                            s.classList.remove('text-gray-300');
                        } else {
                            s.innerHTML = '☆';
                            s.classList.remove('text-yellow-500');
                            s.classList.add('text-gray-300');
                        }
                    });
                });
            });
        }
        
        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.className = `fixed top-20 right-4 z-50 px-6 py-3 rounded-lg shadow-lg text-white ${type === 'success' ? 'bg-green-500' : 'bg-red-500'}`;
            notification.textContent = message;
            document.body.appendChild(notification);
            setTimeout(() => notification.remove(), 3000);
        }
        
        // Корзина
        const addToCartBtn = document.getElementById('add-to-cart');
        if (addToCartBtn) {
            addToCartBtn.addEventListener('click', function() {
                const productId = this.dataset.productId;
                fetch('/cart/add', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                    body: JSON.stringify({ product_id: productId, quantity: 1 })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showNotification(data.message, 'success');
                        document.getElementById('cart-count').textContent = data.cart_count;
                    } else {
                        showNotification(data.message, 'error');
                    }
                });
            });
        }
        
        // Избранное
        const favoriteBtn = document.getElementById('add-to-favorite');
        if (favoriteBtn) {
            favoriteBtn.addEventListener('click', function() {
                const productId = this.dataset.productId;
                fetch('/wishlist/add', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                    body: JSON.stringify({ product_id: productId })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showNotification(data.message, 'success');
                        favoriteBtn.classList.add('bg-red-500', 'text-white');
                        favoriteBtn.classList.remove('bg-gray-100');
                    } else {
                        showNotification(data.message, 'error');
                    }
                });
            });
        }
        
        // Отправка отзыва
        const reviewForm = document.getElementById('review-form');
        if (reviewForm) {
            reviewForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const productId = this.dataset.productId;
                const rating = document.getElementById('rating-value').value;
                const comment = document.getElementById('comment').value;
                
                if (!comment.trim()) {
                    showNotification('Напишите текст отзыва', 'error');
                    return;
                }
                
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = 'Отправка...';
                submitBtn.disabled = true;
                
                fetch(`/products/${productId}/reviews`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ rating: parseInt(rating), comment: comment })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showNotification(data.message, 'success');
                        
                        const reviewsList = document.getElementById('reviews-list');
                        const emptyMessage = reviewsList.querySelector('.text-center');
                        if (emptyMessage && emptyMessage.innerText.includes('Пока нет отзывов')) {
                            emptyMessage.remove();
                        }
                        
                        let starsHtml = '';
                        for (let i = 1; i <= 5; i++) {
                            starsHtml += i <= data.review.rating ? '<span class="text-yellow-500 text-lg">★</span>' : '<span class="text-gray-300 text-lg">☆</span>';
                        }
                        
                        const newReview = `
                            <div class="bg-white rounded-xl shadow-lg p-6" id="review-${data.review.id}">
                                <div class="flex justify-between items-start mb-3">
                                    <div>
                                        <span class="font-semibold text-gray-800">${escapeHtml(data.review.user_name)}</span>
                                        <span class="text-sm text-gray-500 ml-3">${data.review.created_at}</span>
                                    </div>
                                    <button class="delete-review text-red-500 hover:text-red-700 text-sm" data-id="${data.review.id}">Удалить</button>
                                </div>
                                <div class="mb-2 flex gap-1">${starsHtml}</div>
                                <p class="text-gray-700">${escapeHtml(data.review.comment)}</p>
                            </div>
                        `;
                        reviewsList.insertAdjacentHTML('afterbegin', newReview);
                        
                        document.getElementById('comment').value = '';
                        document.getElementById('rating-value').value = '5';
                        
                        const allRatingStars = document.querySelectorAll('.rating-star');
                        allRatingStars.forEach((star, index) => {
                            if (index < 5) {
                                star.innerHTML = '★';
                                star.classList.add('text-yellow-500');
                                star.classList.remove('text-gray-300');
                            }
                        });
                        
                        attachDeleteHandlers();
                    } else {
                        showNotification(data.message || 'Ошибка при отправке отзыва', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Ошибка при отправке отзыва', 'error');
                })
                .finally(() => {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                });
            });
        }
        
        // Удаление отзыва
        function attachDeleteHandlers() {
            document.querySelectorAll('.delete-review').forEach(btn => {
                btn.removeEventListener('click', handleDelete);
                btn.addEventListener('click', handleDelete);
            });
        }
        
        function handleDelete(e) {
            const reviewId = this.dataset.id;
            
            if (confirm('Удалить отзыв?')) {
                const btn = this;
                const originalText = btn.innerHTML;
                btn.innerHTML = '...';
                
                fetch(`/reviews/${reviewId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showNotification(data.message, 'success');
                        const reviewElement = document.getElementById(`review-${reviewId}`);
                        if (reviewElement) {
                            reviewElement.remove();
                        }
                        
                        const reviewsList = document.getElementById('reviews-list');
                        if (reviewsList.children.length === 0 || (reviewsList.children.length === 1 && reviewsList.children[0].classList.contains('text-center'))) {
                            reviewsList.innerHTML = '<div class="bg-white rounded-xl shadow-lg p-6 text-center"><p class="text-gray-500">Пока нет отзывов. Будьте первым!</p></div>';
                        }
                    } else {
                        showNotification(data.message || 'Ошибка при удалении отзыва', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Ошибка при удалении отзыва', 'error');
                })
                .finally(() => {
                    btn.innerHTML = originalText;
                });
            }
        }
        
        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }
        
        attachDeleteHandlers();
    </script>
</body>
</html>