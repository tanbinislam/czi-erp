<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Supplier;
use Carbon\Carbon;
use Session;
use Image;
use Auth;

class SupplierController extends Controller{
    public function __construct(){
      $this->middleware('auth');
    }

    public function index(){
      $all=Supplier::where('supplier_status',1)->orderBy('supplier_id','DESC')->get();
      return view('admin.supplier.all',compact('all'));
    }

    public function add(){
      return view('admin.supplier.add');
    }

    public function edit($slug){
      $data=Supplier::where('supplier_slug',$slug)->firstOrFail();
      return view('admin.supplier.edit', compact('data'));
    }

    public function view($slug){
      $data=Supplier::where('supplier_slug',$slug)->firstOrFail();
      return view('admin.supplier.view', compact('data'));
    }

    public function insert(Request $request){
      $this->validate($request,[
          'name'=>'required',
          'phone'=>'required|unique:suppliers,supplier_phone',
          'email'=>'required',
          'previous_due_amount' => 'numeric',
        ],[
          'name.required'=>'Please enter supplier name!',
          'phone.required'=>'Please enter phone no!',
          'email.required'=>'Please enter email address!',
        ]);
        $slug='supplier'.uniqid();
        $creator=Auth::user()->id;
        $insert=Supplier::insertGetId([
          'supplier_name'=>$request['name'],
          'supplier_phone'=>$request['phone'],
          'supplier_email'=>$request['email'],
          'supplier_address'=>$request['preadd'],
          'supplier_website'=>$request['website'],
          'supplier_company'=>$request['company'],
          'supplier_creator'=>$creator,
          'supplier_slug'=>$slug,
          'previous_due_amount'=>$request->previous_due_amount,
          'created_at'=>carbon::now('Asia/Dhaka')->toDateTimeString(),
        ]);
        if($request->hasFile('pic')){
          $image=$request->file('pic');
          $imageName='supplier_'.$insert.'_'.time().'.'.$image->getClientOriginalExtension();
          Image::make($image)->resize(200,200)->save('uploads/supplier/'.$imageName);
          Supplier::where('supplier_id',$insert)->update([
            'supplier_photo'=>$imageName,
          ]);
        }
        if($insert){
           Session::flash('success');
           return redirect('dashboard/supplier');
       }else{
           return redirect('dashboard/supplier/add');
           Session::flash('error');
       }
    }

    public function update(Request $request){
      $id=$request['id'];
      $this->validate($request,[
          'name'=>'required',
          'phone'=>'required|unique:suppliers,supplier_phone,'.$id.',supplier_id',
          'email'=>'required',
          'previous_due_amount' => 'numeric',
        ],[
          'name.required'=>'Please enter supplier name!',
          'phone.required'=>'Please enter phone no!',
          'email.required'=>'Please enter email address!',
        ]);
        $creator=Auth::user()->id;
        $update=Supplier::where('supplier_status',1)->where('supplier_id',$id)->update([
          'supplier_name'=>$request['name'],
          'supplier_phone'=>$request['phone'],
          'supplier_email'=>$request['email'],
          'supplier_address'=>$request['preadd'],
          'supplier_website'=>$request['website'],
          'supplier_company'=>$request['company'],
          'supplier_creator'=>$creator,
          'previous_due_amount'=>$request->previous_due_amount,
          'updated_at'=>carbon::now('Asia/Dhaka')->toDateTimeString(),
        ]);
        if($request->hasFile('pic')){
          $image=$request->file('pic');
          $imageName='supplier_'.$id.'_'.time().'.'.$image->getClientOriginalExtension();
          Image::make($image)->resize(200,200)->save('uploads/supplier/'.$imageName);
          Supplier::where('supplier_id',$id)->update([
            'supplier_photo'=>$imageName,
          ]);
        }
        if($update){
           Session::flash('upSuccess');
           return redirect('dashboard/supplier');
       }else{
           return redirect('dashboard/supplier/edit');
           Session::flash('error');
       }
    }

    public function softdelete(){
      $id=$_POST['modal_id'];
      $soft=Supplier::where('supplier_status',1)->where('supplier_id',$id)->update([
        'supplier_status'=>'0',
      ]);
      if($soft){
        Session::flash('softSuccess');
        return redirect('dashboard/supplier');
    }else{
        return redirect('dashboard/supplier');
        Session::flash('error');
      }
    }

    public function restore(){

    }

    public function delete(){

    }
}
