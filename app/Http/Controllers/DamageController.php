<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Damage;
use App\Models\MaterialPurchase;
use App\Models\RecipeMake;
use Carbon\Carbon;
use Session;
use Image;
use Auth;

class DamageController extends Controller{
    public function __construct(){
      $this->middleware('auth');
    }


        public function index(){
          $all=Damage::where('damage_status',1)->orderBy('damage_id','DESC')->get();
          return view('admin.damage.all',compact('all'));
        }

        public function getdamage($material_id){
          $data=MaterialPurchase::where('mp_status',1)->where('material_id',$material_id)->get();
          return response()->json($data);
        }

        public function add(){
          return view('admin.damage.add');
        }

        public function edit($slug){
          $data=Damage::where('damage_slug',$slug)->firstOrFail();
          return view('admin.damage.edit', compact('data'));
        }

        public function view($slug){
          $data=Damage::where('damage_slug',$slug)->firstOrFail();
          return view('admin.damage.view', compact('data'));
        }

        public function insert(Request $request){
          $this->validate($request,[
              'material_id'=>'required',
              'mp_id'=>'required',
              'quantity'=>'required',
            ],[
              'material_id.required'=>'Please enter material name!',
              'quantity.required'=>'Please enter quantity!',
              'mp_id.required'=>'Please enter chalan no.!',
            ]);
            $slug='dam-mate-'.uniqid();
            $creator=Auth::user()->id;

            $insert=Damage::insertGetId([
                'material_id'=>$request['material_id'],
                'mp_chalan'=>$request['mp_id'],
                'damage_quantity'=>$request['quantity'],
                'damage_remarks'=>$request['remarks'],
                'damage_creator'=>$creator,
                'damage_slug'=>$slug,
                'created_at'=>carbon::now('Asia/Dhaka')->toDateTimeString(),
            ]);

            if($insert){
               Session::flash('success');
               return redirect('dashboard/material/damage');
           }else{
               return redirect('dashboard/material/damage/add');
               Session::flash('error');
           }
        }

        public function update(Request $request){
          $id= $request['id'];
          $this->validate($request,[
              'material_id'=>'required',
              'mp_id'=>'required',
              'quantity'=>'required',
            ],[
              'material_id.required'=>'Please enter material name!',
              'quantity.required'=>'Please enter quantity!',
              'mp_id.required'=>'Please enter chalan no.!',
            ]);
            $creator=Auth::user()->id;
            $update=Damage::where('damage_status',1)->where('damage_id',$id)->update([
              'material_id'=>$request['material_id'],
              'mp_chalan'=>$request['mp_id'],
              'damage_quantity'=>$request['quantity'],
              'damage_remarks'=>$request['remarks'],
              'damage_creator'=>$creator,
              'updated_at'=>carbon::now('Asia/Dhaka')->toDateTimeString(),
            ]);
            if($update){
               Session::flash('upSuccess');
               return redirect('dashboard/material/damage');
           }else{
               return redirect('dashboard/material/damage/edit');
               Session::flash('error');
           }
        }

        public function softdelete(){
          $id= $_POST['modal_id'];
          $soft=Damage::where('damage_status',1)->where('damage_id',$id)->update([
            'damage_status'=>'0',
          ]);
          if($soft){
            Session::flash('softSuccess');
            return redirect('dashboard/material/damage');
        }else{
            return redirect('dashboard/material/damage');
            Session::flash('error');
          }
        }

    public function restore(Request $request)
    {
      $data = Damage::where('damage_status', 0)->where('id', $request->modal_id)->sole();
      $data->damage_status = 1;
      $data->save();

      Session::flash('success','successfully restored damage information.');
      return back();
    }

    public function delete(Request $request)
    {
      $data = Damage::where('damage_status', 0)->where('id', $request->modal_id)->sole();
      $data->delete();

      Session::flash('success','successfully deleted damage information.');
      return back();
    }
  }
