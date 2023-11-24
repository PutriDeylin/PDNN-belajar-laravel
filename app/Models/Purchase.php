<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'trx_date', 'sub_amount', 'amount_total', 'discount_amount', 'total_products', 'vendor_id', 'description'];

    public function purchaseDetails()
    {
        return $this->hasMany(PurchaseDetail::class);
    }

    public function vendor(){
        return $this->belongsTo(Vendor::class);
    }
}
