<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['product_name', 'category_id', 'product_code', 'is_active', 'description', 'price', 'unit', 'discount_amount', 'stock', 'image', 'is_active'];

    protected $casts = [
        'image' => 'array',
    ];

    public function category(){
        return $this->belongsTo(Product::class);
    }

    public function purchaseDetails()
    {
        return $this->hasMany(PurchaseDetail::class);
    }

    public function salesDetails()
    {
        return $this->hasMany(PurchaseDetail::class);
    }
}
