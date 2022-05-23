<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Employee;
use App\Models\EmployeePaymentView;
use Carbon\Carbon;
use Session;
use Image;
use Auth;

class EmployeeController extends Controller{
    public function __construct(){
      $this->middleware('auth');
    }

    public function index(){
      $all=Employee::with('designation')->where('employee_status',1)->orderBy('employee_id','DESC')->get();
      return view('admin.employee.main.all',compact('all'));
    }

    public function add(){
      return view('admin.employee.main.add');
    }

    public function edit($slug){
      $data=Employee::where('employee_slug',$slug)->firstOrFail();
      return view('admin.employee.main.edit', compact('data'));
    }

    public function profile($slug){

     $emp=Employee::where('employee_slug',$slug)->firstOrFail();
      return view('admin.employee.main.profile', compact('emp'));
    }

    public function insert(Request $request){
      $this->validate($request,[
        'employee_code'=>'required|unique:employees,employee_code',
        'name'=>'required',
        'father'=>'required',
        'mother'=>'required',
        'dob'=>'required',
        'nid'=>'required',
        'phone'=>'required|unique:employees,employee_phone',
        'email'=>'required',
        'blood'=>'required',
        'preadd'=>'required',
        'paradd'=>'required',
        'desig_id'=>'required',
        'department'=>'required',
      ],[
        'employee_code.required'=>'Please enter employee code!',
        'name.required'=>'Please enter employee name!',
        'father.required'=>'Please enter employee fathers name!',
        'mother.required'=>'Please enter employee mothers name!',
        'dob.required'=>'Please enter date of birth!',
        'nid.required'=>'Please enter NID no!',
        'phone.required'=>'Please enter phone no!',
        'email.required'=>'Please enter email address!',
        'blood.required'=>'Please select blood group!',
        'preadd.required'=>'Please enter present address!',
        'paradd.required'=>'Please enter parmanent address!',
        'desig_id.required'=>'Please select designation!',
        'department.required'=>'Please select department!',
      ]);
      $slug='employee'.uniqid();
      $creator=Auth::user()->id;
      $insert=Employee::insertGetId([
        'employee_code'=>$request['employee_code'],
        'employee_name'=>$request['name'],
        'employee_phone'=>$request['phone'],
        'employee_father'=>$request['father'],
        'employee_mother'=>$request['mother'],
        'employee_email'=>$request['email'],
        'employee_dob'=>$request['dob'],
        'employee_nid'=>$request['nid'],
        'blood_id'=>$request['blood'],
        'employee_creator'=>$creator,
        'employee_slug'=>$slug,
        'employee_address'=>$request['preadd'],
        'designation_id' => $request->desig_id,
        'department_id' => $request->department,
        'employee_maritial' => $request->employee_maritial,
        'created_at'=>carbon::now('Asia/Dhaka')->toDateTimeString(),
      ]);

      if($request->hasFile('pic')){
        $image=$request->file('pic');
        $imageName='employee_'.$insert.'_'.time().'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(200,200)->save('uploads/employee/'.$imageName);
        Employee::where('employee_id',$insert)->update([
          'employee_photo'=>$imageName,
        ]);
      }
      if($insert){
           Session::flash('success');
           return redirect('dashboard/employee');
       }else{
           return redirect('dashboard/employee/add');
           Session::flash('error');
       }
    }

    public function update(Request $request){
      $id= $request['id'];
      $this->validate($request,[
          'name'=>'required',
          'father'=>'required',
          'mother'=>'required',
          'dob'=>'required',
          'nid'=>'required',
          'email'=>'required',
          'blood'=>'required',
          'preadd'=>'required',
          'paradd'=>'required',
          'phone'=>'required|unique:employees,employee_phone,'.$id.',employee_id',
          'desig_id'=>'required',
          'department'=>'required',
        ],[
          'name.required'=>'Please enter employee name!',
          'father.required'=>'Please enter employee fathers name!',
          'mother.required'=>'Please enter employee mothers name!',
          'dob.required'=>'Please enter date of birth!',
          'nid.required'=>'Please enter NID no!',
          'phone.required'=>'Please enter phone no!',
          'email.required'=>'Please enter email address!',
          'blood.required'=>'Please select blood group!',
          'preadd.required'=>'Please enter present address!',
          'paradd.required'=>'Please enter parmanent address!',
          'desig_id.required'=>'Please select designation!',
          'department.required'=>'Please select department!',
        ]);
        $id=$request['id'];
        $creator=Auth::user()->id;
        $update=Employee::where('employee_status',1)->where('employee_id',$id)->update([
          'employee_name'=>$request['name'],
          'employee_phone'=>$request['phone'],
          'employee_father'=>$request['father'],
          'employee_mother'=>$request['mother'],
          'employee_email'=>$request['email'],
          'employee_dob'=>$request['dob'],
          'employee_nid'=>$request['nid'],
          'blood_id'=>$request['blood'],
          'employee_address'=>$request['preadd'],
          'employee_creator'=>$creator,
          'employee_address'=>$request['preadd'],
          'designation_id' => $request->desig_id,
          'department_id' => $request->department,
          'employee_maritial' => $request->employee_maritial,
          'updated_at'=>carbon::now('Asia/Dhaka')->toDateTimeString(),
        ]);
        if($request->hasFile('pic')){
          $image=$request->file('pic');
          $imageName='employee_'.$id.'_'.time().'.'.$image->getClientOriginalExtension();
          Image::make($image)->resize(200,200)->save('uploads/employee/'.$imageName);
          Employee::where('employee_id',$id)->update([
            'employee_photo'=>$imageName,
          ]);
        }
        if($update){
           Session::flash('upSuccess');
           return redirect('dashboard/employee');
       }else{
           return redirect('dashboard/employee/edit');
           Session::flash('error');
       }
    }

    public function softdelete(){
      $id= $_POST['modal_id'];
      $soft=Employee::where('employee_status',1)->where('employee_id',$id)->update([
        'employee_status'=>'0',
      ]);
      if($soft){
        Session::flash('softSuccess');
        return redirect('dashboard/employee');
      }else{
        return redirect('dashboard/employee');
        Session::flash('error');
      }
    }

    public function restore(){
      $id= $_POST['modal_id'];
      $soft=Employee::where('employee_status',0)->where('employee_id',$id)->update([
        'employee_status'=>'1',
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
      $id= $_POST['modal_id'];
      $soft=Employee::where('employee_status',0)->where('employee_id',$id)->delete();
      if($soft){
        Session::flash('success', 'Successfuly deleted information');
        return back();
      }else{
        return back();
        Session::flash('error', 'Something went wrong!');
      }
    }

    public function payments($code)
    {
      $emp = Employee::where('employee_status', 1)->where('employee_code', $code)->sole();
      $payments = EmployeePaymentView::where('status', 1)->where('employee_id', $emp->employee_id)->where('is_pay', 1)->get();
      return view('admin.employee.payment.all', compact('payments', 'emp'));
    }
}
