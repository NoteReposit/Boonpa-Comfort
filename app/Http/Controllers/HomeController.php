<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\RoomType;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Home', [
            'products' => Product::with('category', 'roomtype')->get(),
            'categories' => Category::all(),
            'roomtypes' => RoomType::all(),
        ]);
    }
}
