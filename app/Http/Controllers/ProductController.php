<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    // แสดงรายการสินค้าทั้งหมด
    public function index()
    {
        $products = Product::all();
        return Inertia::render('Product/Index', [
            'products' => $products
        ]);
    }

    // แสดงฟอร์มสร้างสินค้าใหม่
    public function create()
    {
        // ดึงข้อมูล categories และ roomtypes
        $categories = Category::all();
        $roomtypes = RoomType::all();

        return Inertia::render('Product/Create', [
            'categories' => $categories,
            'roomtypes' => $roomtypes
        ]);
    }

    // บันทึกข้อมูลสินค้าใหม่
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock_quantity' => 'required|numeric',
            'image_url' => 'nullable|string',
        ]);

        // บันทึกสินค้าใหม่
        Product::create($request->all());

        // Redirect ไปยังหน้า index พร้อมข้อความ success
        return redirect()->route('products.index')->with('success', 'Product saved successfully.');
    }

    // แสดงฟอร์มแก้ไขสินค้า
    public function edit(Product $product)
{
    // ดึงข้อมูล categories และ roomtypes ทั้งหมด
    $categories = Category::all();
    $roomtypes = RoomType::all();

    return Inertia::render('Product/Edit', [
        'product' => $product,
        'categories' => $categories,
        'roomtypes' => $roomtypes,
    ]);
}

    // อัพเดตข้อมูลสินค้า
    public function update(Request $request, Product $product)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric',
        'stock' => 'required|integer',
        'image_url' => 'required|url',
        'category_id' => 'required|exists:categories,id',
        'roomtype_id' => 'required|exists:room_types,id',
    ]);

    $product->update([
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
        'stock_quantity' => $request->stock, // แก้จาก 'stock' เป็น 'stock_quantity'
        'image_url' => $request->image_url,
        'category_id' => $request->category_id,
        'roomtype_id' => $request->roomtype_id,
    ]);

    return redirect()->route('products.index')->with('success', 'Product updated successfully');
}


    // ลบสินค้า
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
