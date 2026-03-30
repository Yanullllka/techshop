<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    // Показать избранное
    public function index()
    {
        $wishlist = Auth::user()->favoriteProducts()->paginate(12);
        return view('wishlist.index', compact('wishlist'));
    }

    // Добавить в избранное
    public function add(Request $request)
    {
        try {
            $request->validate([
                'product_id' => 'required|exists:products,id'
            ]);

            $user = Auth::user();
            $productId = $request->product_id;

            // Проверяем, есть ли уже в избранном
            $exists = $user->favoriteProducts()->where('product_id', $productId)->exists();

            if (!$exists) {
                $user->favoriteProducts()->attach($productId);
                
                return response()->json([
                    'success' => true,
                    'message' => 'Товар добавлен в избранное',
                    'action' => 'added'
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Товар уже в избранном'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка: ' . $e->getMessage()
            ], 500);
        }
    }

   // Удалить из избранного
public function remove($productId)
{
    try {
        // Логируем полученный ID
        \Log::info('Удаление из избранного', [
            'product_id' => $productId,
            'user_id' => Auth::id()
        ]);
        
        $user = Auth::user();
        
        // Проверяем, есть ли такой товар в избранном
        $exists = $user->favoriteProducts()->where('product_id', $productId)->exists();
        \Log::info('Товар в избранном: ' . ($exists ? 'да' : 'нет'));
        
        if ($exists) {
            $user->favoriteProducts()->detach($productId);
            \Log::info('Товар удален');
            
            return response()->json([
                'success' => true,
                'message' => 'Товар удален из избранного'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Товар не найден в избранном'
            ]);
        }
        
    } catch (\Exception $e) {
        \Log::error('Ошибка удаления из избранного', [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
        
        return response()->json([
            'success' => false,
            'message' => 'Ошибка: ' . $e->getMessage()
        ], 500);
    }
}

    // Проверить, в избранном ли товар
    public function check($productId)
    {
        $user = Auth::user();
        $isFavorite = $user->favoriteProducts()->where('product_id', $productId)->exists();
        
        return response()->json([
            'is_favorite' => $isFavorite
        ]);
    }
}