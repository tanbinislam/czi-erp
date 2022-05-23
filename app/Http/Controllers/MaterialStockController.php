<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\MaterialPurchase;
use Faker\Provider\Medical;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MaterialStockController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index()
    {
        //return Material::with('materialPurchases','chalan')->where('material_id',1)->get();

        $materials = Material::with('materialPurchases.joinSupplier')->where('material_status',1)->get();
        return view('admin.material-stock.all', compact('materials'));
    }

    public function used()
    {
        $materials = Material::with('materialPurchases.materialChanalDamages','materialPurchases.makeChalanRecipe')
            ->where('material_status', 1)->get();
        // dd($materials);
        return view('admin.material-stock.used',compact('materials'));
    }


    public function materialDamageWithStock()
    {
        $materials = Material::with('materialPurchases.materialDamages')->get();

        return view('admin.material-stock.list', compact('materials'));

    }

    public function materialPurchases($slug)
    {
        $material = Material::with('materialPurchases.joinSupplier')->where('material_slug', $slug)->where('material_status', 1)->first();
        return view('admin.material-stock.purchases.all', compact('material'));
    }

    public function chanalStock($slug)
    {
         $material = Material::with('materialPurchases.materialChanalDamages','materialPurchases.makeChalanRecipe')
            ->where('material_slug', $slug)
            ->where('material_status', 1)->firstOrFail();

        return view('admin.material-stock.chalan.all',compact('material'));
    }


}
