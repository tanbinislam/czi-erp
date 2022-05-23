<?php

namespace App\Http\Controllers;

use App\Models\RecipeProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RecipeProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }


    public function index()
    {
        $products = RecipeProduct::where('status', 1)->get();
        return view('admin.recipe.product.list.all', compact('products'));
    }

    public function getItem($slug)
    {
        $item = RecipeProduct::where('status', 1)->where('slug', $slug)->firstOrFail();
        return response()->json(['item' => $item]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'unique:recipe_products']
        ]);

        RecipeProduct::create([
            'name' => $request->name,
            'slug' => str($request->name)->slug('_'),
            'status' => 1,
        ]);

        return redirect('/dashboard/recipe-product/list');
    }

    public function update(Request $request, $slug)
    {
        $request->validate([
            'name' => ['required', 'unique:recipe_products']
        ]);

        $item = RecipeProduct::where('status', 1)->where('slug', $slug)->firstOrFail();
        $item->name = $request->name;
        $item->slug = str($request->name)->slug('_');
        $item->save();

        return redirect('/dashboard/recipe-product/list');
    }

    public function softDelete()
    {
        $id = $_POST['modal_id'];
        $soft = RecipeProduct::where('status', 1)->where('id', $id)->update([
            'status' => 0,
        ]);
        if ($soft) {
            Session::flash('softSuccess');
            return redirect('/dashboard/recipe-product/list');
        } else {
            return redirect('/dashboard/recipe-product/list');
            Session::flash('error');
        }
    }

    public function restore()
    {
        $id = $_POST['modal_id'];
        $restore = RecipeProduct::where('status', 0)->where('id', $id)->update([
            'status' => 1,
        ]);
        if ($restore) {
            Session::flash('restoreSuccess');
            return redirect('/dashboard/recipe-product/list');
        } else {
            return redirect('/dashboard/recipe-product/list');
            Session::flash('error');
        }
    }

    public function delete()
    {
        $id = $_POST['modal_id'];
        $delete = RecipeProduct::where('status', 0)->where('id', $id)->delete();
        if ($delete) {
            Session::flash('deleteSuccess');
            return redirect('/dashboard/recipe-product/list');
        } else {
            return redirect('/dashboard/recipe-product/list');
            Session::flash('error');
        }
    }
}
