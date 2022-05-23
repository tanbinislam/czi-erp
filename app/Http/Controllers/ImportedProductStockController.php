<?php

namespace App\Http\Controllers;

use App\Models\ImportedProduct;
use App\Models\ImportedProductStock;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class ImportedProductStockController extends Controller
{
    public function index()
    {
        $all = ImportedProduct::where('status', 1)->get();
        return view('admin.imported-product.stock.index', compact('all'));
    }

    public function create()
    {
        $products = ImportedProduct::where('status', 1)->get();
        return view('admin.imported-product.stock.add', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'imp_product' => ['required', 'numeric'],
            'date' => ['required', 'date'],
            'qty' => ['required', 'numeric'],
            'price' => ['required', 'numeric'],
            'chalan' => ['nullable'],
            'voucher' => ['nullable'],
        ]);

        $slug='imp_pro_stock'.uniqid();

        $insert=ImportedProductStock::insert([
            'imported_product_id'=> $request->imp_product,
            'purchase_date'=> $request->date,
            'purchase_quantity'=> $request->qty,
            'purchase_unit_price'=> $request->price,
            'purchase_total_price' => $request->qty * $request->price,
            'purchase_chalan' => $request->chalan,
            'purchase_voucher' => $request->voucher,
            'purchase_creator' => auth()->user()->id,
            'purchase_slug' => $slug,
            'purchase_status' => 1,
            'created_at'=>Carbon::now('Asia/Dhaka')->toDateTimeString(),
        ]);

        if($insert){
            Session::flash('success');
            return redirect('/dashboard/imported-product/stock');
        }else{
            return redirect('/dashboard/imported-product/stock-purchase/add');
            Session::flash('error');
        }

    }

    public function view($product)
    {
        $imp_product = ImportedProduct::where('status', 1)->where('slug', $product)->sole();
        
        return view('admin.imported-product.stock.view', compact('imp_product'));
    }

    public function edit($product)
    {
        $products = ImportedProduct::where('status', 1)->get();
        $data = ImportedProductStock::where('purchase_status', 1)->where('purchase_slug', $product)->sole();
        return view('admin.imported-product.stock.edit', compact('products', 'data'));
    }

    public function update(Request $request)
    {
        $pro_stock = ImportedProductStock::where('purchase_status', 1)->where('purchase_slug', $request->slug)->sole();
        $request->validate([
            'imp_product' => ['required', 'numeric'],
            'date' => ['required', 'date'],
            'qty' => ['required', 'numeric'],
            'price' => ['required', 'numeric'],
            'chalan' => ['nullable'],
            'voucher' => ['nullable'],
        ]);

        $pro_stock->imported_product_id = $request->imp_product;
        $pro_stock->purchase_date = $request->date;
        $pro_stock->purchase_quantity = $request->qty;
        $pro_stock->purchase_unit_price = $request->price;
        $pro_stock->purchase_total_price  = $request->qty * $request->price;
        $pro_stock->purchase_chalan  = $request->chalan;
        $pro_stock->purchase_voucher  = $request->voucher;
        $pro_stock->purchase_creator  = auth()->user()->id;
        $pro_stock->updated_at = Carbon::now('Asia/Dhaka')->toDateTimeString();
        $pro_stock->save();
        
        Session::flash('success');
        return redirect('/dashboard/imported-product/stock');
        
    }

}
