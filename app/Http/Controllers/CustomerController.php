<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Customer;
use Carbon\Carbon;
use Session;
use Image;
use Auth;

class CustomerController extends Controller{
    public function __construct(){
      $this->middleware('auth');
    }

    public function index(){
      $all=Customer::where('customer_status',1)->orderBy('customer_id','DESC')->get();
      return view('admin.customer.all',compact('all'));
    }

    public function add(){
      return view('admin.customer.add');
    }

    public function edit($slug){
      $data=Customer::where('customer_slug',$slug)->firstOrFail();
      return view('admin.customer.edit', compact('data'));
    }

    public function view($slug){
      $data=Customer::where('customer_slug',$slug)->firstOrFail();
      return view('admin.customer.view', compact('data'));
    }

    public function insert(Request $request){
      $this->validate($request,[
          'name'=>'required',
          'phone'=>'required|unique:customers,customer_phone',
          'email'=>'required',
          'previous_due_amount' => 'numeric',
        ],[
          'name.required'=>'Please enter customer name!',
          'phone.required'=>'Please enter phone no!',
          'email.required'=>'Please enter email address!',
        ]);
        $slug='customer'.uniqid();
        $creator=Auth::user()->id;
        $insert=Customer::insertGetId([
          'customer_name'=>$request['name'],
          'customer_phone'=>$request['phone'],
          'customer_email'=>$request['email'],
          'customer_address'=>$request['preadd'],
          'customer_website'=>$request['website'],
          'customer_company'=>$request['company'],
          'customer_creator'=>$creator,
          'previous_due_amount'=>$request->previous_due_amount,
          'customer_slug'=>$slug,
          'created_at'=>carbon::now('Asia/Dhaka')->toDateTimeString(),
        ]);
        if($request->hasFile('pic')){
          $image=$request->file('pic');
          $imageName='customer_'.$insert.'_'.time().'.'.$image->getClientOriginalExtension();
          Image::make($image)->resize(200,200)->save('uploads/customer/'.$imageName);
          Customer::where('customer_id',$insert)->update([
            'customer_photo'=>$imageName,
          ]);
        }
        if($insert){
           Session::flash('success');
           return redirect('dashboard/customer');
       }else{
           return redirect('dashboard/customer/add');
           Session::flash('error');
       }
    }

    public function update(Request $request){
      $id=$request['id'];
      $this->validate($request,[
          'name'=>'required',
          'phone'=>'required|unique:customers,customer_phone,'.$id.',customer_id',
          'email'=>'required',
          'previous_due_amount' => 'numeric',
        ],[
          'name.required'=>'Please enter customer name!',
          'phone.required'=>'Please enter phone no!',
          'email.required'=>'Please enter email address!',
        ]);
        $creator=Auth::user()->id;
        $update=Customer::where('customer_status',1)->where('customer_id',$id)->update([
          'customer_name'=>$request['name'],
          'customer_phone'=>$request['phone'],
          'customer_email'=>$request['email'],
          'customer_address'=>$request['preadd'],
          'customer_website'=>$request['website'],
          'customer_company'=>$request['company'],
          'customer_creator'=>$creator,
          'previous_due_amount'=>$request->previous_due_amount,
          'updated_at'=>carbon::now('Asia/Dhaka')->toDateTimeString(),
        ]);
        if($request->hasFile('pic')){
          $image=$request->file('pic');
          $imageName='customer_'.$id.'_'.time().'.'.$image->getClientOriginalExtension();
          Image::make($image)->resize(200,200)->save('uploads/customer/'.$imageName);
          Customer::where('customer_id',$id)->update([
            'customer_photo'=>$imageName,
          ]);
        }
        if($update){
           Session::flash('upSuccess');
           return redirect('dashboard/customer');
       }else{
           return redirect('dashboard/customer/add');
           Session::flash('error');
       }
    }

    public function softdelete(){
      $id=$_POST['modal_id'];
      $soft=Customer::where('customer_status',1)->where('customer_id',$id)->update([
        'customer_status'=>'0',
      ]);
      if($soft){
         Session::flash('softSuccess');
         return redirect('dashboard/customer');
     }else{
         return redirect('dashboard/customer');
         Session::flash('error');
     }
    }

    public function restore(Request $request)
    {
      $data = Customer::where('customer_status', 0)->where('customer_id', $request->modal_id)->sole();
      $data->customer_status = 1;
      $data->save();

      Session::flash('success','successfully restored customer information.');
      return back();
    }

    public function delete(Request $request)
    {
      $data = Customer::where('customer_status', 0)->where('customer_id', $request->modal_id)->sole();
      $data->delete();

      Session::flash('success','successfully deleted customer information.');
      return back();
    }


}
