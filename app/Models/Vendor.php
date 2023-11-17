<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name', 'phone_number', 'email', 'address', 'is_active'];

    public function purchase()
    {
        return $this->hasMany(Purchase::class);
    }
}