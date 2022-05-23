<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MadeRecipeProduct extends Model
{
    use HasFactory;

    protected $fillable = [

        'recipe_product_id',
        'quantity',
        'price',
        'recipe_id',
        'date',
        'slug'
    ];

    public function recipe()
    {
        return $this->hasOne(Recipe::class, 'id', 'recipe_id')->where('active',1);
    }

    public function deliveredCustomer()
    {
        return $this->hasMany(CoustomerBuyProduct::class, 'recipe_product_id','id');
    }

    public function totalQuantity()
    {
        return $this->sum('quantity');
    }

    public function deliveredQuantity()
    {
       return $this->deliveredCustomer()->sum('quantity') ;
    }

    public function inStockMadeProduct()
    {
        return  $this->totalQuantity() - $this->deliveredCustomer()->sum('quantity');
    }

    public function recipeProduct()
    {
        return $this->belongsTo(RecipeProduct::class);
    }
}
