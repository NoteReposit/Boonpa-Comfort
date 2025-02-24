<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Inertia\Inertia;
use Inertia\Response;

class ProductController extends Controller
{
    public function index(): Response
    {
        $products = Product::with('category', 'roomtype')->get();

        return Inertia::render('Products/Index', [
            'products' => $products,
        ]);
    }
}
