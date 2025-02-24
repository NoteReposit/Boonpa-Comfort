<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'stock_quantity', 'image_url', 'category_id', 'roomtype_id'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function roomtype()
    {
        return $this->belongsTo(RoomType::class, 'roomtype_id');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'product_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id');
    }

    public function cart()
    {
        return $this->hasMany(Cart::class, 'product_id');
    }

    public function uniqueInfos()
    {
        return $this->hasMany(UniqueInfo::class, 'product_id');
    }
}
