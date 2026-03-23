<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-purple-700">
            Личный кабинет
        </h2>
    </x-slot>

    <div class="p-8">
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h3 class="text-2xl font-bold mb-4">Добро пожаловать, {{ Auth::user()->name }}!</h3>
            <p class="text-gray-600">Это ваш личный кабинет. Здесь вы можете управлять своими заказами и настройками.</p>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                <div class="bg-purple-50 rounded-lg p-6">
                    <div class="text-3xl mb-2">📦</div>
                    <h4 class="font-semibold text-lg mb-2">Мои заказы</h4>
                    <p class="text-gray-600 mb-4">Просмотр истории заказов</p>
                    <a href="/orders" class="text-purple-600 hover:text-purple-700">Перейти →</a>
                </div>
                
                <div class="bg-purple-50 rounded-lg p-6">
                    <div class="text-3xl mb-2">👤</div>
                    <h4 class="font-semibold text-lg mb-2">Профиль</h4>
                    <p class="text-gray-600 mb-4">Редактирование личных данных</p>
                    <a href="/profile" class="text-purple-600 hover:text-purple-700">Перейти →</a>
                </div>
                
                <div class="bg-purple-50 rounded-lg p-6">
                    <div class="text-3xl mb-2">❤️</div>
                    <h4 class="font-semibold text-lg mb-2">Избранное</h4>
                    <p class="text-gray-600 mb-4">Список избранных товаров</p>
                    <a href="/favorites" class="text-purple-600 hover:text-purple-700">Перейти →</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>