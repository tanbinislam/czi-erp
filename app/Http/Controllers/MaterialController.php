<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Material;
use Carbon\Carbon;
use Session;
use Image;
use Auth;

class MaterialController extends Controller{
    public function __construct(){
      $this->middleware('auth');
    }

        public function index(){
          $all=Material::where('material_status',1)->orderBy('material_id','DESC')->get();
          return view('admin.material.all',compact('all'));
        }

        public function add(){
          return view('admin.material.add');
        }

        public function edit($slug){
          $data=Material::where('material_slug',$slug)->firstOrFail();
          return view('admin.material.edit', compact('data'));
        }

        public function view($slug){
          $data=Material::where('material_slug',$slug)->firstOrFail();
          return view('admin.material.view', compact('data'));
        }

        public function insert(Request $request){
          $this->validate($request,[
              'name'=>'required',
            ],[
              'name.required'=>'Please enter material name!',
            ]);
            $slug='material'.uniqid();
            $creator=Auth::user()->id;
            $insert=Material::insertGetId([
              'material_name'=>$request['name'],
              'material_remarks'=>$request['remarks'],
              'material_creator'=>$creator,
              'material_slug'=>$slug,
              'created_at'=>carbon::now('Asia/Dhaka')->toDateTimeString(),
            ]);
            if($request->hasFile('pic')){
              $image=$request->file('pic');
              $imageName='material_'.$insert.'_'.time().'.'.$image->getClientOriginalExtension();
              Image::make($image)->resize(200,200)->save('uploads/material/'.$imageName);
              Material::where('material_id',$insert)->update([
                'material_photo'=>$imageName,
              ]);
            }
            if($insert){
               Session::flash('success');
               return redirect('dashboard/material');
           }else{
               return redirect('dashboard/material/add');
               Session::flash('error');
           }
        }

        public function update(Request $request){
          $this->validate($request,[
              'name'=>'required',
            ],[
              'name.required'=>'Please enter material name!',
            ]);
            $id=$request['id'];
            $creator=Auth::user()->id;
            $update=Material::where('material_status',1)->where('material_id',$id)->update([
              'material_name'=>$request['name'],
              'material_remarks'=>$request['remarks'],
              'material_creator'=>$creator,
              'updated_at'=>carbon::now('Asia/Dhaka')->toDateTimeString(),
            ]);
            if($request->hasFile('pic')){
              $image=$request->file('pic');
              $imageName='material_'.$id.'_'.time().'.'.$image->getClientOriginalExtension();
              Image::make($image)->resize(200,200)->save('uploads/material/'.$imageName);
              Material::where('material_id',$id)->update([
                'material_photo'=>$imageName,
              ]);
            }
            if($update){
               Session::flash('upSuccess');
               return redirect('dashboard/material');
           }else{
               return redirect('dashboard/material/edit');
               Session::flash('error');
           }
        }

        public function softdelete(){
          $id=$_POST['modal_id'];
          $soft=Material::where('material_status',1)->where('material_id',$id)->update([
            'material_status'=>'0',
          ]);
          if($soft){
            Session::flash('softSuccess');
            return redirect('dashboard/material');
        }else{
            return redirect('dashboard/material');
            Session::flash('error');
          }
        }

    public function restore(Request $request)
    {
      $data = Material::where('material_status', 0)->where('id', $request->modal_id)->sole();
      $data->material_status = 1;
      $data->save();

      Session::flash('success','successfully restored material information.');
      return back();
    }

    public function delete(Request $request)
    {
      $data = Material::where('material_status', 0)->where('id', $request->modal_id)->sole();
      $data->delete();

      Session::flash('success','successfully deleted material information.');
      return back();
    }
    }
