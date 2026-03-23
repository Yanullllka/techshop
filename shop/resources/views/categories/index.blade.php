<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-purple-700">
            Категории
        </h2>
    </x-slot>

    <div class="p-6 grid grid-cols-2 md:grid-cols-4 gap-4">

        @foreach($categories as $category)
            <div class="bg-white p-4 rounded-xl shadow text-center hover:bg-purple-50 transition">
                {{ $category->name }}
            </div>
        @endforeach

    </div>
</x-app-layout>