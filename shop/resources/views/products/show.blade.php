<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-4">
            <a href="{{ url()->previous() }}" class="text-purple-600 hover:text-purple-700">
                ← Назад
            </a>
            <h2 class="text-2xl font-bold text-gray-800">
                {{ $product->name }}
            </h2>
        </div>
    </x-slot>

    <div class="p-8 max-w-6xl mx-auto">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="grid md:grid-cols-2 gap-8 p-8">
                <!-- Product Image -->
                <div class="bg-gray-100 rounded-xl h-96 flex items-center justify-center">
                    <svg class="w-48 h-48 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                
                <!-- Product Info -->
                <div>
                    <div class="mb-4">
                        <span class="text-sm text-gray-500">{{ $product->brand->name ?? 'Без бренда' }}</span>
                        <h1 class="text-3xl font-bold text-gray-800 mt-1">{{ $product->name }}</h1>
                    </div>
                    
                    <div class="mb-6">
                        <div class="flex items-center mb-2">
                            <div class="flex text-yellow-400">
                                ★★★★★
                            </div>
                            <span class="ml-2 text-sm text-gray-600">(15 отзывов)</span>
                        </div>
                        <div class="text-3xl font-bold text-purple-600">
                            {{ number_format($product->price, 0, '', ' ') }} ₽
                        </div>
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
                                <span class="text-green-600 font-medium">В наличии</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex gap-4">
                        <button class="flex-1 bg-gradient-to-r from-purple-600 to-pink-600 text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg transition">
                            Добавить в корзину
                        </button>
                        <button class="bg-gray-100 text-gray-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-200 transition">
                            ❤️ Избранное
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Related Products -->
        <div class="mt-12">
            <h2 class="text-2xl font-bold mb-6">Похожие товары</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedProducts ?? [] as $related)
                    <div class="bg-white rounded-xl shadow-lg p-4 hover:shadow-xl transition">
                        <div class="h-32 bg-gray-100 rounded-lg mb-3"></div>
                        <h3 class="font-semibold">{{ $related->name }}</h3>
                        <p class="text-purple-600 font-bold mt-2">{{ number_format($related->price, 0, '', ' ') }} ₽</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>