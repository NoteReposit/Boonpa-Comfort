<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class OrderController extends Controller
{
    public function index(): Response
    {
        $orders = Order::where('user_id', Auth::id())
            ->with('orderDetails.product')
            ->orderBy('order_date', 'desc')
            ->paginate(10); // เพิ่ม Pagination

        return Inertia::render('Orders/Index', [
            'orders' => $orders,
        ]);
    }

    public function show($id): Response
    {
        $order = Order::with('orderDetails.product')
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return Inertia::render('Orders/Show', [
            'order' => $order,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        $user = Auth::user();
        $total_price = 0;

        // สร้างคำสั่งซื้อ
        $order = Order::create([
            'user_id' => $user->id,
            'order_date' => now(),
            'total_price' => 0, // คำนวณทีหลัง
            'status' => 'pending',
        ]);

        foreach ($validated['items'] as $item) {
            $product = Product::findOrFail($item['product_id']);

            // ตรวจสอบ stock
            if ($product->stock_quantity < $item['quantity']) {
                return redirect()->back()->withErrors(['message' => "สินค้า {$product->name} มีไม่พอ"]);
            }

            $subtotal = $product->price * $item['quantity'];
            $total_price += $subtotal;

            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $item['quantity'],
                'price_per_unit' => $product->price,
                'subtotal' => $subtotal,
            ]);

            // ลด stock สินค้า
            $product->decrement('stock_quantity', $item['quantity']);
        }

        // อัปเดตราคาสั่งซื้อ
        $order->update(['total_price' => $total_price]);

        return redirect()->route('orders.index')->with('success', 'สั่งซื้อสำเร็จ');
    }
}
