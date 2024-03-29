<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image', 'description', 'price', 'categorie_id'];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'categorie_id');
    }

    public function promotions()
    {
        return $this->belongsToMany(Promotion::class, 'product_promotion')->withPivot('promotionPrice');
    }
}
