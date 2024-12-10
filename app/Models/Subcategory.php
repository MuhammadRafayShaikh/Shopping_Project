<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_name', 'id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_cat', 'id');
    }

    // public function rcategory()
    // {
    //     return $this->hasOne(Category::class, 'id','cat_name');
    // }
}
