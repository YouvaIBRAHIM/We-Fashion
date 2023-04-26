<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'is_visible',
        'state',
        'product_ref'
    ];
    /**
    * Récupère les catégories d'un produit
    */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
    * Récupère les tailles d'un produit
    */
    public function sizes()
    {
        return $this->belongsToMany(Size::class);
    }
}
