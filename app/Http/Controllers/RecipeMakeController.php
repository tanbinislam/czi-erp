<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Recipe;
use App\Models\RecipeMake;
use Faker\Provider\Medical;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RecipeMakeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index($id)
    {
        $all = Recipe::with('makeRecipes')->where('id', $id)->firstOrFail();
        return view('admin.recipe.make.all', compact('all'));

    }

    public function makeList()
    {
        $recepies = RecipeMake::all();
        $all = $recepies->unique('date');
        return view('admin.recipe.make.list', compact('all'));
    }

    public function makeListView($recepie_id, $date)
    {
        $all = RecipeMake::where('recipe_id', $recepie_id)->where('date', $date)->get();
        return view('admin.recipe.make.list-view', compact('all'));
    }

    public function create(Request $request)
    {
        if ($request) {
            $recipes = Recipe::where('active', 1)->orderBy('id', 'desc')->get();
            $materials = Material::where('material_status', 1)->with('materialPurchases.materialDamages')->orderBy('material_id', 'desc')->get();
            $makeRecipes = RecipeMake::where('recipe_id',$request->recipe)->where('date',$request->date)->get();
            return view('admin.recipe.make.create', compact('recipes', 'materials','makeRecipes'));
        }else{
            $recipes = Recipe::where('active', 1)->orderBy('id', 'desc')->get();
            $materials = Material::where('material_status', 1)->with('materialPurchases.materialDamages')->orderBy('material_id', 'desc')->get();
            return view('admin.recipe.make.create', compact('recipes', 'materials'));
        }

    }

    public function delete()
    {
        $id = $_POST['modal_id'];
        $soft = RecipeMake::where('id', $id)->firstOrFail();
        $soft->delete();
        if ($soft) {
            Session::flash('softSuccess');
            return redirect('dashboard/recipe-make-list');
        } else {
            return redirect('dashboard/recipe-make-list');
            Session::flash('error');
        }
    }

    public function materialRecipe(Request $request)
    {
        $id = $request->material_id;
        $material = Material::with('materialPurchases.materialDamages')->where('material_id', $id)->where('material_status', 1)->first();

        return response()->json(['success' => $material]);
    }

    public function recipeStore(Request $request)
    {
        $data = $request->all();
        $makeRecipe = new RecipeMake();
        $makeRecipe->recipe_id = $data['recipe_id'];
        $makeRecipe->date = $data['date'];
        $makeRecipe->material_id = $data['material_id'];
        $makeRecipe->chalan_name = $data['mp_chalan'];
        $makeRecipe->quantity = $data['quantity'];
        $makeRecipe->save();

        if (Session::flash('success') == true) {
            Session::flash('success');
            return redirect("dashboard/recipe-make?recipe=$makeRecipe->recipe_id&date=$makeRecipe->date");
        } else {
            return redirect("dashboard/recipe-make?recipe=$makeRecipe->recipe_id&date=$makeRecipe->date");
            Session::flash('error');
        }


    }
}
