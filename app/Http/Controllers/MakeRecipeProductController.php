<?php

namespace App\Http\Controllers;

use App\Models\MadeRecipeProduct;
use App\Models\Recipe;
use App\Models\RecipeMake;
use App\Models\RecipeProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MakeRecipeProductController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index()
    {
        $recipes = Recipe::where('active', 1)->orderBy('id', 'DESC')->get();
        $products = RecipeProduct::where('status', 1)->orderBy('id', 'DESC')->get();
        $all = MadeRecipeProduct::where('status', 1)->with('recipe')->get();
        return view('admin.recipe.product.all', compact('all', 'recipes', 'products'));
    }

    public function getDates($recipe_id)
    {
        $recepies = RecipeMake::where('recipe_id', $recipe_id)->get();
        $all = $recepies->unique('date');
        return response()->json(['data' => $all->pluck('date')]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'recipe' => 'required',
            'product' => 'required',
            'date' => 'required',
            'quantity' => 'required',
            'price' => 'required'
        ]);

        $insert = MadeRecipeProduct::create([
            'recipe_id' => $request->recipe,
            'recipe_product_id' => $request->product,
            'date' => $request->date,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'slug' => 'RP-'.uniqid(),
        ]);

        if ($insert) {
            Session::flash('success');
            return redirect('dashboard/recipe-product');
        } else {
            return redirect('dashboard/recipe-product');
            Session::flash('error');
        }
    }

    public function getProduct($slug)   
    {
        $product = MadeRecipeProduct::where('status', 1)->where('slug', $slug)->sole();
        return response()->json(['data' => $product]);
    }

    public function update(Request $request, $slug)
    {
        $request->validate([
            'recipe' => 'required',
            'product' => 'required',
            'date' => 'required',
            'quantity' => 'required',
            'price' => 'required'
        ]);

        $product = MadeRecipeProduct::where('status', 1)->where('slug', $slug)->sole();
        $product->recipe_id = $request->recipe;
        $product->recipe_product_id = $request->product;
        $product->date = $request->date;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->save();
        
        Session::flash('upSuccess', 'Information updated successfuly!');
        return redirect('dashboard/recipe-product');
        
    }

    public function sofDelete()
    {
        $id = $_POST['modal_id'];
        $soft = MadeRecipeProduct::where('status', 1)->where('id', $id)->firstOrFail();
        $soft->status = 0;
        $soft->save();
        if ($soft) {
            Session::flash('softSuccess');
            return redirect('dashboard/recipe-product');
        } else {
            return redirect('dashboard/recipe-product');
            Session::flash('error');
        }
    }

    public function restore(Request $request)
    {
      $data = MadeRecipeProduct::where('status', 0)->where('id', $request->modal_id)->sole();
      $data->status = 1;
      $data->save();

      Session::flash('success','successfully restored recipe product information.');
      return back();
    }

    public function delete(Request $request)
    {
      $data = MadeRecipeProduct::where('status', 0)->where('id', $request->modal_id)->sole();
      $data->delete();

      Session::flash('success','successfully deleted recipe product information.');
      return back();
    }
}
