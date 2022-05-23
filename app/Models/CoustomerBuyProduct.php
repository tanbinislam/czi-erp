<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoustomerBuyProduct extends Model
{
    use HasFactory;

    protected $table = 'coustomer_buy_products';
    protected $fillable = ['price','quantity','customer_id','recipe_product_id', 'purchase_date'];

    public function customers()
    {
        return $this->hasOne(Customer::class, 'customer_id', 'customer_id');
    }
    public function products()
    {
        return $this->hasOne(RecipeProduct::class, 'id', 'recipe_product_id');
    }
}
