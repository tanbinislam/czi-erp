<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\MaterialPurchase;
use Illuminate\Http\Request;

class MaterialPurchaseResponseController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function getPurchaseInfo(Request $request)
    {
        $maId = Material::where('material_id', $request->material_id)->first();
        $mp = MaterialPurchase::where('material_id', $maId->material_id)->where('mp_chalan', $request->mp_chalan)->first();
       $rr= ($mp->mp_quantity - ($mp->totalmakeChalanRecipe() + $mp->ChanalDamagesQuantity()));
        return response()->json($rr);


       /* $mp = Material::with('materialPurchases.materialChanalDamages','materialPurchases.makeChalanRecipe')
            ->where('material_id', $request->material_id)
            ->where('material_status', 1)->firstOrFail();*/

       // return response()->json($mp);
    }
}
