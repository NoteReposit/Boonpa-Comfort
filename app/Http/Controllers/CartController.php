<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class CartController extends Controller
{
    public function index(): Response
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();

        return Inertia::render('Cart/Index', [
            'cartItems' => $cartItems,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = Cart::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
            ],
            [
                'quantity' => $request->quantity,
            ]
        );

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function placeOrder(Request $request)
    {
        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        $order = Order::create([
            'user_id' => $user->id,
            'order_date' => now(),
            'total_price' => $cartItems->sum(fn($item) => $item->quantity * $item->product->price),
            'status' => 'Pending',
        ]);

        foreach ($cartItems as $item) {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price_per_unit' => $item->product->price,
                'subtotal' => $item->quantity * $item->product->price,
            ]);
        }

        // Clear the cart
        Cart::where('user_id', $user->id)->delete();

        return redirect()->route('orders.index')->with('success', 'Order placed successfully!');
    }
}