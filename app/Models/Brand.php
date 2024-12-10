<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Subcategory::class, 'brand_cat', 'id');
    }

    // public function rcategory()
    // {
    //     return $this->hasOne(Category::class, 'id', 'brand_cat');
    // }
}
