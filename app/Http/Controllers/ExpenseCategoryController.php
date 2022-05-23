<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\ExpenseCategory;
use Carbon\Carbon;
use Session;
use Image;
use Auth;

class ExpenseCategoryController extends Controller{
    public function __construct(){
      $this->middleware('auth');
    }

    public function index(){
      $all=ExpenseCategory::where('exp_cat_status',1)->orderBy('exp_cat_id','DESC')->get();
      return view('admin.expense-category.all',compact('all'));
    }

    public function add(){
      return view('admin.expense-category.add');
    }

    public function edit($slug){
      $data=ExpenseCategory::where('exp_cat_slug',$slug)->firstOrFail();
      return view('admin.expense-category.edit', compact('data'));
    }

    public function view($slug){
      $data=ExpenseCategory::where('exp_cat_slug',$slug)->firstOrFail();
      return view('admin.expense-category.view', compact('data'));
    }

    public function insert(Request $request){
      $this->validate($request,[
          'name'=>'required|unique:expense_categories,exp_cat_name'
        ],[
          'name.required'=>'Please enter Expense Category name!',
        ]);
        $slug = Str::slug($request->name, '-');
        $creator=Auth::user()->id;
        $insert=ExpenseCategory::insertGetId([
          'exp_cat_name'=>$request['name'],
          'exp_cat_remarks'=>$request['remarks'],
          'exp_cat_creator'=>$creator,
          'exp_cat_slug'=>$slug,
          'created_at'=>carbon::now('Asia/Dhaka')->toDateTimeString(),
        ]);
        if($insert){
           Session::flash('success');
           return redirect('dashboard/expense/category');
       }else{
           return redirect('dashboard/expense/category/add');
           Session::flash('error');
       }
    }

    public function update(Request $request){
      $id= $request['id'];
      $this->validate($request,[
          'name'=>'required|unique:expense_categories,exp_cat_name,'.$id.',exp_cat_id'
        ],[
          'name.required'=>'Please enter Expense Category name!',
        ]);
        $creator=Auth::user()->id;
        $slug = Str::slug($request->name, '-');
        $update=ExpenseCategory::where('exp_cat_status',1)->where('exp_cat_id',$id)->update([
          'exp_cat_name'=>$request['name'],
          'exp_cat_remarks'=>$request['remarks'],
          'exp_cat_creator'=>$creator,
          'exp_cat_slug'=>$slug,
          'updated_at'=>carbon::now('Asia/Dhaka')->toDateTimeString(),
        ]);
        if($update){
           Session::flash('upSuccess');
           return redirect('dashboard/expense/category');
       }else{
           return redirect('dashboard/expense/category/edit');
           Session::flash('error');
       }
    }

    public function softdelete(){
      $id=$_POST['modal_id'];
      $soft=ExpenseCategory::where('exp_cat_status',1)->where('exp_cat_id',$id)->update([
        'exp_cat_status'=>'0',
      ]);
      if($soft){
        Session::flash('softSuccess');
        return redirect('dashboard/expense/category');
    }else{
        return redirect('dashboard/expense/category');
        Session::flash('error');
      }
    }

    public function restore(){
      $id=$_POST['modal_id'];
      $soft=ExpenseCategory::where('exp_cat_status',0)->where('exp_cat_id',$id)->update([
        'exp_cat_status'=>'1',
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
      $soft=ExpenseCategory::where('exp_cat_status',0)->where('exp_cat_id',$id)->delete([]);

      if($soft){
        Session::flash('success', 'Successfuly deleted information');
        return back();
      }else{
        return back();
        Session::flash('error', 'Something went wrong!');
      }
    }
}
