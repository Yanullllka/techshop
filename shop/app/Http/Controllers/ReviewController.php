<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, $productId)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Для добавления отзыва необходимо авторизоваться'
            ], 401);
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:1|max:1000'
        ]);

        $review = Review::create([
            'user_id' => Auth::id(),
            'product_id' => $productId,
            'rating' => $request->rating,
            'comment' => $request->comment
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Отзыв добавлен',
            'review' => [
                'id' => $review->id,
                'rating' => $review->rating,
                'comment' => $review->comment,
                'user_name' => Auth::user()->name,
                'created_at' => $review->created_at->format('d.m.Y H:i')
            ]
        ]);
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        
        if (Auth::id() !== $review->user_id) {
            return response()->json([
                'success' => false,
                'message' => 'Вы не можете удалить этот отзыв'
            ], 403);
        }

        $review->delete();

        return response()->json([
            'success' => true,
            'message' => 'Отзыв удален'
        ]);
    }
}