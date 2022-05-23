<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RecipeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = Recipe::where('active', 1)->orderBy('id', 'DESC')->get();
        return view('admin.recipe.all', compact('all'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.recipe.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ], [
            'name.required' => 'Please enter recipe name!',
        ]);
        $slug = 'dam-mate-' . uniqid();
        //$creator=Auth::user()->id;

        $insert = Recipe::create([
            'name' => $request->name,
            'slug' => $slug,
            'active' => 1
        ]);
        if ($insert) {
            Session::flash('success');
            return redirect('dashboard/recipe');
        } else {
            return redirect('dashboard/recipe');
            Session::flash('error');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Recipe $recipe
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $data = Recipe::where('slug', $slug)->firstOrFail();

        return view('admin.recipe.edit', compact('data'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Recipe $recipe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recipe $recipe)
    {

        $this->validate($request, [
            'name' => 'required',
        ], [
            'name.required' => 'Please enter recipe name!',
        ]);

        $insert = $recipe->update([
            'name' => $request->name,
        ]);
        if ($insert) {
            Session::flash('success');
            return redirect('dashboard/recipe');
        } else {
            return redirect('dashboard/recipe/create');
            Session::flash('error');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Recipe $recipe
     * @return \Illuminate\Http\Response
     */
    public function softdelete()
    {
        $id = $_POST['modal_id'];
        $soft = Recipe::where('active', 1)->where('id', $id)->update([
            'active' => 0,
        ]);
        if ($soft) {
            Session::flash('softSuccess');
            return redirect('dashboard/recipe');
        } else {
            return redirect('dashboard/recipe');
            Session::flash('error');
        }
    }

    public function restore(Request $request)
    {
      $data = Recipe::where('active', 0)->where('id', $request->modal_id)->sole();
      $data->active = 1;
      $data->save();

      Session::flash('success','successfully restored recipe information.');
      return back();
    }

    public function delete(Request $request)
    {
      $data = Recipe::where('active', 0)->where('id', $request->modal_id)->sole();
      $data->delete();

      Session::flash('success','successfully deleted recipe information.');
      return back();
    }
}
