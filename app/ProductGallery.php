<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductGallery extends Model
{
    protected $fillable = [
    'photos', 'products_id'
    ];

    protected $hidden = [
        
    ];

     // merelasikan produk gallery dengan produk
    public function product()
    {
        // ->withTrashed()
        return $this->belongsTo(Product::class, 'products_id', 'id');
    }
}
