<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'product_sub_cat', 'id');
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'product_brand', 'id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'product_id');
    }
}
