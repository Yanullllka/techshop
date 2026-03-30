<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-3xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                Добро пожаловать в TechShop
            </h2>
            <a href="/products" class="text-purple-600 hover:text-purple-700 font-medium">
                Смотреть все →
            </a>
        </div>
    </x-slot>

    <div class="p-8">
        <div class="bg-gradient-to-r from-purple-600 to-pink-600 rounded-2xl p-8 mb-12 text-white">
            <div class="max-w-2xl">
                <h1 class="text-4xl font-bold mb-4">Новинки техники 2024</h1>
                <p class="text-lg mb-6 opacity-90">Скидки до 30% на последние модели смартфонов и ноутбуков</p>
                <a href="/products" class="inline-block bg-white text-purple-600 px-6 py-3 rounded-lg font-semibold hover:shadow-lg transition">
                Перейти к покупкам →
                </a>
            </div>
        </div>

        <div class="mb-12">
            <h2 class="text-2xl font-bold mb-6 flex items-center">
                <span class="bg-gradient-to-r from-purple-600 to-pink-600 w-1 h-8 rounded-full mr-3"></span>
                Новинки
                <span class="ml-3 text-sm text-gray-500 font-normal">Горячие новинки сезона</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($products->take(4) as $product)
                    <div class="group bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden">
                        <div class="relative h-48 bg-gray-100">
                            <div class="absolute inset-0 flex items-center justify-center text-gray-400">
                                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div class="absolute top-2 right-2 bg-red-500 text-white text-xs px-2 py-1 rounded-full">
                                NEW
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-1 group-hover:text-purple-600 transition">
                                {{ $product->name }}
                            </h3>
                            <p class="text-gray-500 text-sm mb-3">{{ Str::limit($product->description ?? 'Описание товара', 60) }}</p>
                            <div class="flex justify-between items-center">
                                <span class="text-2xl font-bold text-purple-600">{{ number_format($product->price, 0, '', ' ') }} $</span>
                                <button class="bg-purple-600 text-white p-2 rounded-lg hover:bg-purple-700 transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div>
            <h2 class="text-2xl font-bold mb-6 flex items-center">
                <span class="bg-gradient-to-r from-purple-600 to-pink-600 w-1 h-8 rounded-full mr-3"></span>
                Популярные товары
                <span class="ml-3 text-sm text-gray-500 font-normal">Лучшие выборы покупателей</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($products->skip(4)->take(4) as $product)
                    <div class="bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden">
                        <div class="h-48 bg-gray-100 flex items-center justify-center">
                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-1">{{ $product->name }}</h3>
                            <p class="text-gray-500 text-sm mb-3">{{ Str::limit($product->description ?? 'Описание товара', 60) }}</p>
                            <div class="flex justify-between items-center">
                                <span class="text-2xl font-bold text-purple-600">{{ number_format($product->price, 0, '', ' ') }} $</span>
                                <button class="bg-purple-600 text-white p-2 rounded-lg hover:bg-purple-700 transition">
                                    В корзину
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>