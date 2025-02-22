<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UniqueInfo extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'product_id'];

    protected $table = 'unique_info';

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
