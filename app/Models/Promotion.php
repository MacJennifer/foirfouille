<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'reduction', 'date_debut', 'date_fin'];

    public function products(){

        return $this->belongsToMany(Product::class, 'product_promotion')->withPivot('promotionPrice');
}
    }

