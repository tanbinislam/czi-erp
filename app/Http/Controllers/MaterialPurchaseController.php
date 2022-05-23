<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\MaterialPurchase;
use Carbon\Carbon;
use Session;
use Image;
use Auth;
use Illuminate\Validation\Rule;

class MaterialPurchaseController extends Controller{
    public function __construct(){
      $this->middleware('auth');
    }


        public function index(){
          $purchases=MaterialPurchase::where('mp_status',1)->orderBy('mp_id','DESC')->get();
          $all = $purchases->unique('mp_chalan');
          return view('admin.purchase.all',compact('all'));
        }

        public function add(){
            $materials = Material::where('material_status',1)->get();
            $suppliers = Supplier::where('supplier_status',1)->get();
          return view('admin.purchase.add',compact('materials','suppliers'));
        }

        public function edit($slug){
          $materials = Material::where('material_status',1)->get();
          $suppliers = Supplier::where('supplier_status',1)->get();
          $all_purchase=MaterialPurchase::where('mp_status', 1)->where('mp_slug',$slug)->get();
          return view('admin.purchase.edit', compact('all_purchase', 'materials','suppliers'));
        }

        public function view($slug){
          $materials=MaterialPurchase::where('mp_status', 1)->where('mp_slug',$slug)->get();
          return view('admin.purchase.view', compact('materials'));
        }

        public function insert(Request $request){

          $this->validate($request,[
              'material_id.*'=>'required|numeric',
              'supplier_id'=>'required',
              'quantity.*'=>'required',
              'price.*'=>'required',
              'date'=>'required',
              'chalan'=>'required|unique:material_purchases,mp_chalan',
              'voucher'=>'nullable|unique:material_purchases,mp_voucher',
            ],[
              'material_id.*.required'=>'Please enter material name!',
              'supplier_id.required'=>'Please enter supplier name!',
              'quantity.*.required'=>'Please enter quantity!',
              'price.*.required'=>'Please enter price!',
              'chalan.required'=>'Please enter chalan no.!',
            ]);

            $slug ='mat-pur'.uniqid();

            foreach ($request['material_id'] as $key => $value) {
                $materialPurchase = new MaterialPurchase();
                $materialPurchase->material_id = $request['material_id'][$key];
                $materialPurchase->mp_date = $request['date'];
                $materialPurchase->supplier_id = $request['supplier_id'];
                $materialPurchase->mp_quantity = $request['quantity'][$key];
                $materialPurchase->mp_unit_price = $request['price'][$key];
                $materialPurchase->mp_total_price = $request['price'][$key] * $request['quantity'][$key];
                $materialPurchase->mp_chalan = $request['chalan'];
                $materialPurchase->mp_voucher = $request['voucher'];
                $materialPurchase->mp_creator = auth()->user()->id;
                $materialPurchase->mp_slug = $slug;
                $materialPurchase->save();
            }
            return response()->json(['success', 'Material purchase data added successfully']);
        }

        public function update(Request $request){
          $chalan = MaterialPurchase::where('mp_status',1)->where('mp_slug', $request->slug)->firstOrFail();
          // dd($request);
          $this->validate($request,[
            'material_id.*'=>'required|numeric',
            'supplier_id'=>'required',
            'quantity.*'=>'required',
            'price.*'=>'required',
            'date'=>'required',
            'chalan'=>['required'],
            'voucher'=>['nullable'],
          ],[
            'material_id.*.required'=>'Please enter material name!',
            'supplier_id.required'=>'Please enter supplier name!',
            'quantity.*.required'=>'Please enter quantity!',
            'price.*.required'=>'Please enter price!',
            'chalan.required'=>'Please enter chalan no.!',
          ]);

          foreach ($request['material_id'] as $key => $value) {
            if($key < $request->count){
              $update = MaterialPurchase::where('mp_status',1)->where('mp_id', $request->p_id)->firstOrFail();
              $update->material_id = $request['material_id'][$key];
              $update->mp_date = $request['date'];
              $update->supplier_id = $request['supplier_id'];
              $update->mp_quantity = $request['quantity'][$key];
              $update->mp_unit_price = $request['price'][$key];
              $update->mp_total_price = $request['price'][$key] * $request['quantity'][$key];
              $update->mp_chalan = $request['chalan'];
              $update->mp_voucher = $request['voucher'];
              $update->save();
            }else{
              $insert = new MaterialPurchase();
              $insert->material_id = $request['material_id'][$key];
              $insert->mp_date = $request['date'];
              $insert->supplier_id = $request['supplier_id'];
              $insert->mp_quantity = $request['quantity'][$key];
              $insert->mp_unit_price = $request['price'][$key];
              $insert->mp_total_price = $request['price'][$key] * $request['quantity'][$key];
              $insert->mp_chalan = $request['chalan'];
              $insert->mp_voucher = $request['voucher'];
              $insert->mp_creator = auth()->user()->id;
              $insert->mp_slug = $request->slug;
              $insert->save();
            }
          }
          return response()->json(['success', 'Material purchase data updated successfully']);
          
        }

        public function softdelete(Request $request){
          $id= $request['modal_id'];
          $soft= MaterialPurchase::where('mp_status',1)->where('mp_id',$id)->firstOrFail();
          $soft->mp_status = 0;
          $soft->save();
      
          Session::flash('softSuccess');
          return redirect('/dashboard/material/purchase/edit/'.$soft->mp_slug);
        
        }

        public function restore(Request $request)
    {
      $data = MaterialPurchase::where('mp_status', 0)->where('id', $request->modal_id)->sole();
      $data->mp_status = 1;
      $data->save();

      Session::flash('success','successfully restored material purchase information.');
      return back();
    }

    public function delete(Request $request)
    {
      $data = MaterialPurchase::where('mp_status', 0)->where('id', $request->modal_id)->sole();
      $data->delete();

      Session::flash('success','successfully deleted material purchase information.');
      return back();
    }
    }
