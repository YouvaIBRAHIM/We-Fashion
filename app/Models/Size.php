<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Size extends Model
{
    use HasFactory;

    /**
    * Récupère les produits d'une taille
    */
    public function products() : BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'products_sizes');
    }
}
