<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Expense;
use Carbon\Carbon;
use Session;
use Image;
use Auth;

class ExpenseController extends Controller{
    public function __construct(){
      $this->middleware('auth');
    }

    public function index(){
      $all=Expense::where('expens_status',1)->orderBy('expens_date','DESC')->get();
      return view('admin.expense.all',compact('all'));
    }

    public function add(){
      return view('admin.expense.add');
    }

    public function edit($slug){
      $data=Expense::where('expens_slug',$slug)->firstOrFail();
      return view('admin.expense.edit', compact('data'));
    }

    public function view($slug){
      $data=Expense::where('expens_slug',$slug)->firstOrFail();
      return view('admin.expense.view', compact('data'));
    }

    public function insert(Request $request){
      $this->validate($request,[
          'exp_cat_id'=>'required',
          'details'=>'required',
          'amount'=>'required|numeric',
          'date'=>'required',
        ],[
          'exp_cat_id.required'=>'Please select Category name!',
          'amount.required'=>'Please enter Expense amount!',
          'amount.numeric'=>'Please enter numerical value!',
          'date.required'=>'Please select Expense date!',
        ]);
        $slug='expens'.uniqid();
        $creator=Auth::user()->id;
        $insert=Expense::insertGetId([
          'exp_cat_id'=>$request['exp_cat_id'],
          'expens_date'=>$request['date'],
          'expens_amount'=>$request['amount'],
          'expens_details'=>$request['details'],
          'expens_creator'=>$creator,
          'expens_slug'=>$slug,
          'created_at'=>carbon::now('Asia/Dhaka')->toDateTimeString(),
        ]);
        if($insert){
           Session::flash('success');
           return redirect('dashboard/expense');
       }else{
           return redirect('dashboard/expense/add');
           Session::flash('error');
       }
    }

    public function update(Request $request){
      $id= $request['id'];
      $this->validate($request,[
          'exp_cat_id'=>'required',
          'amount'=>'required|numeric',
          'details'=>'required',
          'date'=>'required',
        ],[
          'exp_cat_id.required'=>'Please select Category name!',
          'amount.required'=>'Please enter Expense amount!',
          'amount.numeric'=>'Please enter numerical value!',
          'date.required'=>'Please select Expense date!',
        ]);
        $creator=Auth::user()->id;
        $update=Expense::where('expens_status',1)->where('expens_id',$id)->update([
            'exp_cat_id'=>$request['exp_cat_id'],
            'expens_date'=>$request['date'],
            'expens_amount'=>$request['amount'],
            'expens_details'=>$request['details'],
            'expens_creator'=>$creator,
            'updated_at'=>carbon::now('Asia/Dhaka')->toDateTimeString(),
        ]);
        if($update){
           Session::flash('upSuccess');
           return redirect('dashboard/expense');
       }else{
           return redirect('dashboard/expense/edit');
           Session::flash('error');
       }
    }

    public function softdelete(){
      $id= $_POST['modal_id'];
      $soft=Expense::where('expens_status',1)->where('expens_id',$id)->update([
        'expens_status'=>'0',
      ]);
      if($soft){
        Session::flash('softSuccess');
        return redirect('dashboard/expense');
    }else{
        return redirect('dashboard/expense');
        Session::flash('error');
      }
    }

    public function restore(){
      $id=$_POST['modal_id'];
      $soft=Expense::where('expens_status',0)->where('expens_id',$id)->update([
        'expens_status'=>1,
        'updated_at'=>Carbon::now()->toDateTimeString(),
      ]);

      if($soft){
        Session::flash('success','successfully restore expense information.');
        return back();
      }else{
        Session::flash('error','please try again.');
        return back();
      }
    }

    public function delete(){
      $id=$_POST['modal_id'];
      $del=Expense::where('expens_status',0)->where('expens_id',$id)->delete([]);

      if($del){
        Session::flash('success','successfully delete expense information permanently.');
        return back();
      }else{
        Session::flash('error','please try again.');
        return back();
      }
    }
}
