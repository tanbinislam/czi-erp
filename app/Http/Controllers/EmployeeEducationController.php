<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Employee;
use App\Models\EmployeeEducation;
use Carbon\Carbon;
use Session;
use Image;
use Auth;

class EmployeeEducationController extends Controller{
  public function __construct(){
    $this->middleware('auth');
  }

  public function index($code){
    $emp=Employee::where('employee_status',1)->where('employee_code',$code)->firstOrFail();
    return view('admin.employee.education.all',compact('emp'));
  }

  public function edit($code,$slug){
    $emp=Employee::where('employee_status',1)->where('employee_code',$code)->firstOrFail();
    $data=EmployeeEducation::where('empedu_status',1)->where('empedu_slug',$slug)->firstOrFail();
    return view('admin.employee.education.edit',compact('emp','data'));
  }

  public function view($code,$slug){
    $emp=Employee::where('employee_status',1)->where('employee_code',$code)->firstOrFail();
    $data=EmployeeEducation::where('empedu_status',1)->where('empedu_slug',$slug)->firstOrFail();
    return view('admin.employee.education.view',compact('emp','data'));
  }

  public function insert(Request $request){
    $this->validate($request,[
      'title'=>'required',
    ],[
      'title.required'=>'Please enter certificate title',
    ]);

    $employee=$request['employee'];
    $code=$request['code'];
    $slug='EC'.uniqid();
    $creator=Auth::user()->id;
    $insert=EmployeeEducation::insertGetId([
      'employee_id'=>$employee,
      'empedu_title'=>$request['title'],
      'empedu_institute'=>$request['institute'],
      'empedu_year'=>$request['year'],
      'empedu_result'=>$request['result'],
      'empedu_remarks'=>$request['remarks'],
      'empedu_creator'=>$creator,
      'empedu_slug'=>$slug,
      'created_at'=>Carbon::now()->toDateTimeString(),
    ]);

    if($insert){
      Session::flash('success','successfully add educational information.');
      return redirect('dashboard/employee/'.$code.'/education');
    }else{
      Session::flash('error','please try again.');
      return redirect('dashboard/employee/'.$code.'/education');
    }
  }

  public function update(Request $request){
    $this->validate($request,[
      'title'=>'required',
    ],[
      'title.required'=>'Please enter certificate title',
    ]);

    $code=$request['code'];
    $id=$request['id'];
    $slug=$request['slug'];
    $creator=Auth::user()->id;
    $insert=EmployeeEducation::where('empedu_status',1)->where('empedu_id',$id)->update([
      'empedu_title'=>$request['title'],
      'empedu_institute'=>$request['institute'],
      'empedu_year'=>$request['year'],
      'empedu_result'=>$request['result'],
      'empedu_remarks'=>$request['remarks'],
      'empedu_creator'=>$creator,
      'updated_at'=>Carbon::now()->toDateTimeString(),
    ]);

    if($insert){
      Session::flash('success','successfully update educational information.');
      return redirect('dashboard/employee/'.$code.'/education/view/'.$slug);
    }else{
      Session::flash('error','please try again.');
      return redirect('dashboard/employee/'.$code.'/education/edit/'.$slug);
    }
  }

  public function softDelete(Request $request)
  {
    $edu = EmployeeEducation::where('empedu_status', 1)->where('empedu_id', $request->modal_id)->firstOrFail();
    $edu->empedu_status = 0;
    $edu->save();
    Session::flash('success','successfully soft deleted educational information.');
    return back();

  }

  public function restore(Request $request)
  {
    $edu = EmployeeEducation::where('empedu_status', 0)->where('empedu_id', $request->modal_id)->firstOrFail();
    $edu->empedu_status = 1;
    $edu->save();
    Session::flash('success','successfully restored educational information.');
    return back();
  }

  public function delete(Request $request)
  {
    $edu = EmployeeEducation::where('empedu_status', 1)->where('empedu_id', $request->modal_id)->firstOrFail();
    $edu->delete();
    Session::flash('success','successfully deleted educational information.');
    return back();
  }
}
