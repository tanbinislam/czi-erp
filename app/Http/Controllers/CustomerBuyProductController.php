<?php

namespace App\Http\Controllers;

use App\Models\CoustomerBuyProduct;
use App\Models\Customer;
use App\Models\MadeRecipeProduct;
use App\Models\Recipe;
use App\Models\RecipeProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CustomerBuyProductController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index()
    {
        $all = CoustomerBuyProduct::with('customers','products')->orderBy('purchase_date', 'ASC')->get();
        return view('admin.customer.product.all',compact('all'));

    }

    public function create($slug)
    {

        $customer = Customer::where('customer_slug', $slug)->where('customer_status', 1)->firstOrFail();
        // $products = Recipe::with('productPrice')->where('active',1)->get();
        $products = RecipeProduct::where('status', 1)->get();
        return view('admin.customer.product.add',compact('products','customer'));
    }

    public function store(Request $request)
    {
       // return $request->all();
        $insert =  CoustomerBuyProduct::create($request->all());
        if($insert){
            Session::flash('success');
            return redirect('dashboard/customer/product-deliver');
        }else{
            return redirect('dashboard/customer/product-deliver');
            Session::flash('error');
        }
    }

    public function makeProductItem(Request $request)
    {

        // $recipeProduct = RecipeProduct::with('madeProducts')->where('id',$request->recipe_product_id)->firstOrFail();
        // $productQuantity = $MadeRecipeProduct->inStockMadeProduct();
        // return response()->json($productQuantity, 200);

        $recipeProduct = RecipeProduct::with('madeProducts')->where('id',$request->recipe_product_id)->firstOrFail();
        $all_products = $recipeProduct->madeProducts->sum('quantity');
        $sold_product = CoustomerBuyProduct::where('recipe_product_id', $request->recipe_product_id)->sum('quantity');
        $available_stock = $all_products - $sold_product;
        return response()->json(['available_stock' => $available_stock]);

    }
}
