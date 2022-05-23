<?php

namespace App\Http\Controllers;

use App\Models\CoustomerBuyProduct;
use App\Models\MadeRecipeProduct;
use App\Models\RecipeProduct;
use Illuminate\Http\Request;

class MadeProductStockController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index()
    {
        $products = RecipeProduct::where('status', 1)->with('madeProducts', 'customerBuyProduct')->get();
        
        return view('admin.product-stock.all', compact('products'));
    }
}
