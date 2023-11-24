<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'trx_date', 'sub_amount', 'amount_total', 'discount_amount', 'total_products', 'customer_id', 'description'];

    public function salesDetails()
    {
        return $this->hasMany(SaleDetail::class);
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
