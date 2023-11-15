<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['product_name', 'category_id', 'product_code', 'price', 'image'];

    protected $casts = [
        'image' => 'array',
    ];
    
    public function category(){
        return $this->belongsTo(Product::class);
    }
}
