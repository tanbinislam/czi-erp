<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\IncomeCategory;
use App\Models\Income;
use Carbon\Carbon;
use Session;
use Image;
use Auth;

class IncomeController extends Controller{
    public function __construct(){
      $this->middleware('auth');
    }

    public function index(){
      $all=Income::where('income_status',1)->orderBy('income_date','DESC')->get();
      return view('admin.income.all',compact('all'));
    }

    public function add(){
      $IncomeCategory=IncomeCategory::where('in_cat_status',1)->get();
      return view('admin.income.add',compact('IncomeCategory'));
    }

    public function edit($slug){
      $data=Income::where('income_slug',$slug)->firstOrFail();
      return view('admin.income.edit', compact('data'));
    }

    public function view($slug){
      $data=Income::where('income_slug',$slug)->firstOrFail();
      return view('admin.income.view', compact('data'));
    }

    public function insert(Request $request){
      $this->validate($request,[
          'in_cat_id'=>'required',
          'details'=>'required',
          'amount'=>'required|numeric',
          'date'=>'required',
        ],[
          'in_cat_id.required'=>'Please select Category name!',
          'amount.required'=>'Please enter Income amount!',
          'amount.numeric'=>'Please enter numerical value!',
          'date.required'=>'Please select Income date!',
        ]);
        $slug=uniqid('income');
        $creator=Auth::user()->id;
        $insert=Income::insertGetId([
          'in_cat_id'=>$request['in_cat_id'],
          'income_date'=>$request['date'],
          'income_amount'=>$request['amount'],
          'income_details'=>$request['details'],
          'income_creator'=>$creator,
          'income_slug'=>$slug,
          'created_at'=>carbon::now('Asia/Dhaka')->toDateTimeString(),
        ]);
        if($insert){
           Session::flash('success');
           return redirect('dashboard/income');
       }else{
           return redirect('dashboard/income/add');
           Session::flash('error');
       }
    }

    public function update(Request $request){
      $id= $request['id'];
      $this->validate($request,[
          'in_cat_id'=>'required',
          'details'=>'required',
          'amount'=>'required|numeric',
          'date'=>'required',
        ],[
          'in_cat_id.required'=>'Please select Category name!',
          'amount.required'=>'Please enter Income amount!',
          'amount.numeric'=>'Please enter numerical value!',
          'date.required'=>'Please select Income date!',
        ]);
        $creator=Auth::user()->id;
        $update=Income::where('income_status',1)->where('income_id',$id)->update([
            'in_cat_id'=>$request['in_cat_id'],
            'income_date'=>$request['date'],
            'income_amount'=>$request['amount'],
            'income_details'=>$request['details'],
            'income_creator'=>$creator,
            'updated_at'=>carbon::now('Asia/Dhaka')->toDateTimeString(),
        ]);
        if($update){
           Session::flash('upSuccess');
           return redirect('dashboard/income');
       }else{
           return redirect('dashboard/income/edit');
           Session::flash('error');
       }
    }

    public function softdelete(){
      $id= $_POST['modal_id'];
      $soft=Income::where('income_status',1)->where('income_id',$id)->update([
        'income_status'=>'0',
      ]);
      if($soft){
        Session::flash('softSuccess');
        return redirect('dashboard/income');
    }else{
        return redirect('dashboard/income');
        Session::flash('error');
      }
    }

    public function restore(){
      $id=$_POST['modal_id'];
      $soft=Income::where('income_status',0)->where('income_id',$id)->update([
        'income_status'=>1,
        'updated_at'=>Carbon::now()->toDateTimeString(),
      ]);

      if($soft){
        Session::flash('success','successfully restore income information.');
        return back();
      }else{
        Session::flash('error','please try again.');
        return back();
      }
    }

    public function delete(){
      $id=$_POST['modal_id'];
      $del=Income::where('income_status',0)->where('income_id',$id)->delete([]);

      if($del){
        Session::flash('success','successfully delete income information permanently.');
        return back();
      }else{
        Session::flash('error','please try again.');
        return back();
      }
    }
}
