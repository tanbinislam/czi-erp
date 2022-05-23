<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Designation;
use Carbon\Carbon;
use Session;
use Image;
use Auth;

class DesignationController extends Controller{
  public function __construct(){
    $this->middleware('auth');
  }

      public function index(){
        $all=Designation::where('designation_status',1)->orderBy('designation_id','DESC')->get();
        return view('admin.designation.all',compact('all'));
      }

      public function add(){
        return view('admin.designation.add');
      }

      public function edit($slug){
        $data=Designation::where('designation_slug',$slug)->firstOrFail();
        return view('admin.designation.edit', compact('data'));
      }

      public function view($slug){
        $data=Designation::where('designation_slug',$slug)->firstOrFail();
        return view('admin.designation.view', compact('data'));
      }

      public function insert(Request $request){
        $this->validate($request,[
            'name'=>'required|unique:designations,designation_name',
          ],[
            'name.required'=>'Please enter designation name!',
          ]);
          $slug = Str::slug($request->name, '-');
          $creator=Auth::user()->id;
          $insert=Designation::insertGetId([
            'designation_name'=>$request['name'],
            'designation_remarks'=>$request['remarks'],
            'designation_creator'=>$creator,
            'designation_slug'=>$slug,
            'created_at'=>carbon::now('Asia/Dhaka')->toDateTimeString(),
          ]);
          if($insert){
             Session::flash('success');
             return redirect('dashboard/designation');
         }else{
             return redirect('dashboard/designation/add');
             Session::flash('error');
         }
      }

      public function update(Request $request){
        $id= $request['id'];
        $this->validate($request,[
            'name'=>'required|unique:designations,designation_name,'.$id.',designation_id'
          ],[
            'name.required'=>'Please enter designation name!',
          ]);
          $creator=Auth::user()->id;
          $slug = Str::slug($request->name, '-');
          $update=Designation::where('designation_status',1)->where('designation_id',$id)->update([
            'designation_name'=>$request['name'],
            'designation_remarks'=>$request['remarks'],
            'designation_creator'=>$creator,
            'designation_slug'=>$slug,
            'updated_at'=>carbon::now('Asia/Dhaka')->toDateTimeString(),
          ]);
          if($update){
             Session::flash('upSuccess');
             return redirect('dashboard/designation');
         }else{
             return redirect('dashboard/designation/edit');
             Session::flash('error');
         }
      }

      public function softdelete(){
        $id=$_POST['modal_id'];
        $soft=Designation::where('designation_status',1)->where('designation_id',$id)->update([
          'designation_status'=>'0',
        ]);
        if($soft){
          Session::flash('softSuccess');
          return redirect('dashboard/designation');
      }else{
          return redirect('dashboard/designation');
          Session::flash('error');
        }
      }

      public function restore(){
        $id=$_POST['modal_id'];
        $soft=Designation::where('designation_status',0)->where('designation_id',$id)->update([
          'designation_status'=>'1',
        ]);
        if($soft){
          Session::flash('success', 'Successfuly restored information');
          return back();
      }else{
          return back();
          Session::flash('error', 'Something went wrong!');
        }
      }

      public function delete(){
        $id=$_POST['modal_id'];
        $soft=Designation::where('designation_status',1)->where('designation_id',$id)->delete();
        if($soft){
          Session::flash('success', 'Successfuly deleted information');
          return back();
      }else{
          return back();
          Session::flash('error', 'Something went wrong!');
        }
      }
  }
