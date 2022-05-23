<?php

namespace App\Http\Controllers;

use App\Models\EmployeeContact;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\EmployeeEducation;
use Carbon\Carbon;
use Session;
use Image;
use Auth;

class EmployeeContactController extends Controller{

    public function index($code){
       $emp=Employee::with('contact')->where('employee_status',1)->where('employee_code',$code)->firstOrFail();
       $contacts=EmployeeContact::where('employee_id',$emp->employee_id)->where('status',1)->get();
       return view('admin.employee.contact-info.all',compact('emp', 'contacts'));
    }

    public function edit($code,$id){
    $emp=Employee::with(['contact'])->where('employee_status',1)->where('employee_code',$code)->firstOrFail();
    $data=EmployeeContact::where('status',1)->where('id',$id)->firstOrFail();
    return view('admin.employee.contact-info.edit',compact('emp','data'));
  }

  public function view($code,$id){
    $emp=Employee::with(['contact'])->where('employee_status',1)->where('employee_code',$code)->firstOrFail();
    $data=EmployeeContact::where('status',1)->where('id',$id)->firstOrFail();
    return view('admin.employee.contact-info.view',compact('emp','data'));
  }


    public function insert(Request $request){
          $this->validate($request,[
          'phone'=>'required',
          'email'=>'required',
        ],[
          'title.required'=>'Please enter certificate title',
        ]);

        $insert=EmployeeContact::insertGetId([
          'employee_id'=>$request->employee_id,
          'phone'=>$request['phone'],
          'address'=>$request['address'],
          'email'=>$request['email'],
          'created_at'=>Carbon::now()->toDateTimeString(),
        ]);

        if($insert){
          Session::flash('success','successfully add contact information.');
          return back();
        }else{
          Session::flash('error','please try again.');
          return back();
        }

    }


      public function update(Request $request){

        $this->validate($request,[
          'phone'=>'required',
          'email'=>'required',
        ],[
          'title.required'=>'Please enter certificate title',
        ]);

        $employee=$request['employee'];
        $code=$request['code'];
        $id=$request['id'];
        $update=EmployeeContact::where('id',$id)->update([
          'employee_id'=>$employee,
          'phone'=>$request['phone'],
          'address'=>$request['address'],
          'email'=>$request['email'],
          'created_at'=>Carbon::now()->toDateTimeString(),
        ]);

        if($update){
          Session::flash('success','successfully update contact information.');
          return redirect('dashboard/employee/'.$code.'/contact/info');
        }else{
          Session::flash('error','please try again.');
          return redirect('dashboard/employee/'.$code.'/contact/info');
        }

    }

    public function softdelete(){
        $id=$_POST['modal_id'];
        $code=$_POST['code'];
        $soft=EmployeeContact::where('status',1)->where('id',$id)->update([
          'status'=>'0',
        ]);

        if($soft){
          Session::flash('success','successfully delete contact information.');
          return redirect('dashboard/employee/'.$code.'/contact/info');
        }else{
          Session::flash('error','please try again.');
          return redirect('dashboard/employee/'.$code.'/contact/info');
        }

      }

      public function restore(){
          $id=$_POST['modal_id'];
          $code=$_POST['code'];
          $soft=EmployeeContact::where('status',0)->where('id',$id)->update([
          'status'=>'1',
        ]);

        if($soft){
          Session::flash('success','successfully restore contact information.');
          return redirect('dashboard/employee/'.$code.'/contact/info');
        }else{
          Session::flash('error','please try again.');
          return redirect('dashboard/employee/'.$code.'/contact/info');
        }
      }

      public function delete(){
          $id=$_POST['modal_id'];
          $code=$_POST['code'];
          $soft=EmployeeContact::where('status',0)->where('id',$id)->delete();

        if($soft){
          Session::flash('success','successfully restore contact information.');
          return redirect('dashboard/employee/'.$code.'/contact/info');
        }else{
          Session::flash('error','please try again.');
          return redirect('dashboard/employee/'.$code.'/contact/info');
        }
      }


}
