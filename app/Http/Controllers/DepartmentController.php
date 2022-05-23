<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Department;
use Carbon\Carbon;
use Session;
use Image;
use Auth;

class DepartmentController extends Controller{
  public function __construct(){
    $this->middleware('auth');
  }

      public function index(){
        $all=Department::where('department_status',1)->orderBy('department_id','DESC')->get();
        return view('admin.department.all',compact('all'));
      }

      public function add(){
        return view('admin.department.add');
      }

      public function edit($slug){
        $data=Department::where('department_slug',$slug)->firstOrFail();
        return view('admin.department.edit', compact('data'));
      }

      public function view($slug){
        $data=Department::where('department_slug',$slug)->firstOrFail();
        return view('admin.department.view', compact('data'));
      }

      public function insert(Request $request){
        $this->validate($request,[
            'name'=>'required|unique:departments,department_name'
          ],[
            'name.required'=>'Please enter department name!',
          ]);
          $slug = Str::slug($request->name, '-');
          $creator=Auth::user()->id;
          $insert=Department::insertGetId([
            'department_name'=>$request['name'],
            'department_remarks'=>$request['remarks'],
            'department_creator'=>$creator,
            'department_slug'=>$slug,
            'created_at'=>carbon::now('Asia/Dhaka')->toDateTimeString(),
          ]);
          if($insert){
             Session::flash('success');
             return redirect('dashboard/department');
         }else{
             return redirect('dashboard/department/add');
             Session::flash('error');
         }
      }

      public function update(Request $request){
        $id= $request['id'];
        $this->validate($request,[
            'name'=>'required|unique:departments,department_name,'.$id.',department_id'
          ],[
            'name.required'=>'Please enter department name!',
          ]);
          $creator=Auth::user()->id;
          $slug = Str::slug($request->name, '-');
          $update=Department::where('department_status',1)->where('department_id',$id)->update([
            'department_name'=>$request['name'],
            'department_remarks'=>$request['remarks'],
            'department_creator'=>$creator,
            'department_slug'=>$slug,
            'updated_at'=>carbon::now('Asia/Dhaka')->toDateTimeString(),
          ]);
          if($update){
             Session::flash('upSuccess');
             return redirect('dashboard/department');
         }else{
             return redirect('dashboard/department/edit');
             Session::flash('error');
         }
      }

      public function softdelete(){
        $id=$_POST['modal_id'];
        $soft=Department::where('department_status',1)->where('department_id',$id)->update([
          'department_status'=>'0',
        ]);
        if($soft){
          Session::flash('softSuccess');
          return redirect('dashboard/department');
        }else{
          return redirect('dashboard/department');
          Session::flash('error');
        }
      }

      public function restore(){
        $id=$_POST['modal_id'];
        $soft=Department::where('department_status',0)->where('department_id',$id)->update([
          'department_status'=>'1',
        ]);
        if($soft){
          Session::flash('softSuccess', 'Successfuly restored information');
          return back();
        }else{
          return back();
          Session::flash('error', 'Something went wrong!');
        }
      }

      public function delete(){
        $id=$_POST['modal_id'];
        $soft=Department::where('department_status',0)->where('department_id',$id)->delete();
        if($soft){
          Session::flash('softSuccess', 'Successfuly deleted information');
          return back();
        }else{
          return back();
          Session::flash('error', 'Something went wrong!');
        }
      }
  }
