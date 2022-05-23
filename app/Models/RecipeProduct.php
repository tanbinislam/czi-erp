<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeProduct extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'status', 'slug'];

    public function madeProducts()
    {
        return $this->hasMany(MadeRecipeProduct::class);
    }

    public function customerBuyProduct()
    {
        return $this->hasMany(CoustomerBuyProduct::class);
    }
}
