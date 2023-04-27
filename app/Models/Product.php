<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

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
    public function categories() : BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'products_categories');
    }

    /**
    * Récupère les tailles d'un produit
    */
    public function sizes() : BelongsToMany
    {
        return $this->belongsToMany(Size::class, 'products_sizes');
    }
}
