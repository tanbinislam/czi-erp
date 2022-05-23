<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierProfile extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function profile($slug)
    {
        $supplier = Supplier::with('materialSupply.joinMaterial','supplyPayment.user')->where('supplier_slug', $slug)->where('supplier_status', 1)->firstOrFail();
        return view('admin.supplier.profile.overview', compact('supplier'));
    }

    public function printReport($slug)
    {
        $supplier = Supplier::with('materialSupply.joinMaterial','supplyPayment.user')->where('supplier_slug', $slug)->where('supplier_status', 1)->firstOrFail();
        return view('admin.supplier.profile.report', compact('supplier'));
    }


}
