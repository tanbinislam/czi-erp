<?php

namespace App\Http\Controllers;

use App\Models\EmployeeDocument;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\EmployeeEducation;
use Carbon\Carbon;
use Session;
use Image;
use Auth;

class EmployeeDocumentController extends Controller{
  public function __construct(){
    $this->middleware('auth');
  }
  public function index($code){
      $emp=Employee::with(['document'])->where('employee_status',1)->where('employee_code',$code)->firstOrFail();
       return view('admin.employee.document.all',compact('emp'));
    }
    
    public function edit($code,$id){
    $emp=Employee::with(['document'])->where('employee_status',1)->where('employee_code',$code)->firstOrFail();
    $data=EmployeeDocument::where('status',1)->where('id',$id)->firstOrFail();
    return view('admin.employee.document.edit',compact('emp','data'));
  }

  public function view($code,$id){
    $emp=Employee::with(['document'])->where('employee_status',1)->where('employee_code',$code)->firstOrFail();
    $data=EmployeeDocument::where('status',1)->where('id',$id)->firstOrFail();
    return view('admin.employee.document.view',compact('emp','data'));
  }


    public function insert(Request $request){
          $this->validate($request,[
          'title'=>'required',
          'subtitle'=>'required',
        ],[
          'title.required'=>'Please document title',
          'subtitle.required'=>'Please document subtitle',
        ]);

        $employee=$request['employee'];
        $code=$request['code'];
        $insert=EmployeeDocument::insertGetId([
          'employee_id'=>$employee,
          'title'=>$request['title'],
          'sub_title'=>$request['subtitle'],
          'image'=>'',
          'created_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($request->hasFile('pic')){
          $image=$request->file('pic');
          $imageName='document_'.$insert.'_'.time().'.'.$image->getClientOriginalExtension();
          Image::make($image)->resize(200,200)->save('uploads/document/'.$imageName);
          EmployeeDocument::where('id',$insert)->update([
            'image'=>$imageName,
          ]);
        }

        if($insert){
          Session::flash('success','successfully add document information.');
          return redirect('dashboard/employee/'.$code.'/document');
        }else{
          Session::flash('error','please try again.');
          return redirect('dashboard/employee/'.$code.'/document');
        }
  
    }


      public function update(Request $request){
          $this->validate($request,[
          'title'=>'required',
          'subtitle'=>'required',
        ],[
          'title.required'=>'Please document title',
          'subtitle.required'=>'Please document subtitle',
        ]);

        $employee=$request['employee'];
        $code=$request['code'];
        $id=$request['id'];
        $update=EmployeeDocument::where('id',$id)->update([
          'employee_id'=>$employee,
          'title'=>$request['title'],
          'sub_title'=>$request['subtitle'],
          'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($request->hasFile('pic')){
          $image=$request->file('pic');
          $imageName='document_'.$id.'_'.time().'.'.$image->getClientOriginalExtension();
          Image::make($image)->resize(200,200)->save('uploads/document/'.$imageName);
          EmployeeDocument::where('id',$id)->update([
            'image'=>$imageName,
          ]);
        }

        if($update){
          Session::flash('success','successfully update document information.');
          return redirect('dashboard/employee/'.$code.'/document');
        }else{
          Session::flash('error','please try again.');
          return redirect('dashboard/employee/'.$code.'/document');
        }
  
    }

    public function softdelete(){
        $id=$_POST['modal_id'];
        $code=$_POST['code'];
        $soft=EmployeeDocument::where('status',1)->where('id',$id)->update([
          'status'=>'0',
        ]);
        
        if($soft){
          Session::flash('success','successfully delete document information.');
          return redirect('dashboard/employee/'.$code.'/document');
        }else{
          Session::flash('error','please try again.');
          return redirect('dashboard/employee/'.$code.'/document');
        }

      }

      public function restore(){
          $id=$_POST['modal_id'];
          $code=$_POST['code'];
        $soft=EmployeeDocument::where('status',0)->where('id',$id)->update([
          'status'=>'1',
        ]);
        
        if($soft){
          Session::flash('success','successfully restore document information.');
          return redirect('dashboard/employee/'.$code.'/document');
        }else{
          Session::flash('error','please try again.');
          return redirect('dashboard/employee/'.$code.'/document');
        }
      }

      public function delete(){

      }
   

   
}