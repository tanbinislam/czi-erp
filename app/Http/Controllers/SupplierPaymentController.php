<?php

namespace App\Http\Controllers;

use App\Models\MaterialPurchase;
use App\Models\Supplier;
use App\Models\SupplierPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SupplierPaymentController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index()
    {
        $suppliers =Supplier::with('materialSupply')->where('supplier_status',1)->get();
       return view('admin.purchase.supplier-payment.all',compact('suppliers'));
    }
    public function create($slug)
    {
        $supplier =Supplier::where('supplier_slug',$slug)->where('supplier_status',1)->firstOrFail();
        return view('admin.purchase.supplier-payment.add',compact('supplier'));
    }

    public function store(Request $request,$slug)
    {

        $supplier =Supplier::where('supplier_slug',$slug)->where('supplier_status',1)->firstOrFail();

        $request->validate([
            'supplier_id' => 'required',
            'payable_amount' => 'required',
            'paid_date' => 'required',
        ]);

        $insert= SupplierPayment::create([
            'supplier_id' => $request->supplier_id,
            'payable_amount' => $request->payable_amount,
            'paid_date' => $request->paid_date,
            'user_id' => auth()->id(),
        ]);

        if($insert){
            Session::flash('success');
            return redirect('dashboard/material/supplier-payment');
        }else{
            return redirect("dashboard/material/supplier-payment/");
            Session::flash('error');
        }




    }

    public function getSupplyInfo(Request $request)
    {
       $supplier= Supplier::with('materialSupply')->where('supplier_id', $request->supplier_id)->where('supplier_status', 1)->firstOrfail();
        return response()->json($supplier,200);
    }
}
