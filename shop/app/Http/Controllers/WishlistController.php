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
        // Проверка авторизации
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Для добавления в избранное необходимо авторизоваться'
            ], 401);
        }
        
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
            $user = Auth::user();
            
            // Проверяем, есть ли такой товар в избранном
            $exists = $user->favoriteProducts()->where('product_id', $productId)->exists();
            
            if ($exists) {
                $user->favoriteProducts()->detach($productId);
                
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