<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    private function getCart()
    {
        if (Auth::check()) {
            $cart = Cart::firstOrCreate(
                ['user_id' => Auth::id()],
                ['session_id' => null]
            );
        } else {
            $sessionId = session()->getId();
            $cart = Cart::firstOrCreate(
                ['session_id' => $sessionId],
                ['user_id' => null]
            );
        }
        
        return $cart->load('items.product');
    }

    public function add(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Для добавления товара в корзину необходимо авторизоваться'
            ], 401);
        }
        
        try {
            $request->validate([
                'product_id' => 'required|exists:products,id',
                'quantity' => 'integer|min:1|max:999'
            ]);

            $product = Product::findOrFail($request->product_id);
            $cart = $this->getCart();
            
            $cartItem = $cart->items()->where('product_id', $product->id)->first();
            
            if ($cartItem) {
                $cartItem->quantity += $request->quantity ?? 1;
                $cartItem->save();
            } else {
                CartItem::create([
                    'cart_id' => $cart->id,
                    'product_id' => $product->id,
                    'quantity' => $request->quantity ?? 1,
                    'price' => $product->price
                ]);
            }
            
            $cart->load('items');
            $cartCount = $cart->items->sum('quantity');
            
            return response()->json([
                'success' => true,
                'message' => 'Товар добавлен в корзину',
                'cart_count' => $cartCount
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка при добавлении товара: ' . $e->getMessage()
            ], 500);
        }
    }

    public function index()
    {
        $cart = $this->getCart();
        return view('cart.index', compact('cart'));
    }

    public function update(Request $request, $itemId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:999'
        ]);
        
        $cartItem = CartItem::findOrFail($itemId);
        $cartItem->quantity = $request->quantity;
        $cartItem->save();
        
        return redirect()->back()->with('success', 'Корзина обновлена');
    }

    public function remove($itemId)
    {
        $cartItem = CartItem::findOrFail($itemId);
        $cartItem->delete();
        
        return redirect()->back()->with('success', 'Товар удален из корзины');
    }

    public function clear()
    {
        $cart = $this->getCart();
        $cart->items()->delete();
        
        return redirect()->back()->with('success', 'Корзина очищена');
    }
    
    public function checkout(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Для оформления заказа необходимо авторизоваться'
            ], 401);
        }
        
        try {
            $cart = $this->getCart();
            
            if ($cart->items->count() == 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Корзина пуста'
                ]);
            }

            $order = Order::create([
                'user_id' => Auth::id(),
                'total_price' => $cart->total,
                'status' => 'new',
                'address' => Auth::user()->address ?? 'Не указан',
                'payment_method' => 'cash_on_delivery'
            ]);

            foreach ($cart->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price
                ]);
            }

            $cart->items()->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Ваш заказ передан в доставку. Менеджер свяжется с вами.'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка при оформлении заказа: ' . $e->getMessage()
            ], 500);
        }
    }
}