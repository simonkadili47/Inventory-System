<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    // Define the relationship with Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
