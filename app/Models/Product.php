<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['product_name', 'buying_price', 'selling_price'];

    public function sales()
    {
        return $this->hasMany(Sales::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
