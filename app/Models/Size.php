<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $table = 'sizes';
    /**
    * Récupère les produits d'une taille
    */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
