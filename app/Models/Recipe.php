<?php
 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = ['name','slug','active'];

    public function makeRecipes()
    {
        return $this->hasMany(RecipeMake::class, 'recipe_id', 'id');
    }

    public function productQuantity()
    {
        return $this->makeRecipes()->sum('quantity');
    }

    public function productPrice()
    {
        return $this->belongsTo(MadeRecipeProduct::class,'id','recipe_id');
    }



}
