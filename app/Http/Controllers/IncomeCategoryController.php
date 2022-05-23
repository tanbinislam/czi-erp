<?php

namespace App\Http\Controllers;

use App\Models\ExpenseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\IncomeCategory;
use Carbon\Carbon;
use Session;
use Image;
use Auth;

class IncomeCategoryController extends Controller{
    public function __construct(){
      $this->middleware('auth');
    }

    public function index(){
      $all=IncomeCategory::where('in_cat_status',1)->orderBy('in_cat_id','DESC')->get();
      return view('admin.income-category.all',compact('all'));
    }

    public function add(){
      return view('admin.income-category.add');
    }

    public function edit($slug){
      $data=IncomeCategory::where('in_cat_slug',$slug)->firstOrFail();
      return view('admin.income-category.edit', compact('data'));
    }

    public function view($slug){
      $data=IncomeCategory::where('in_cat_slug',$slug)->firstOrFail();
      return view('admin.income-category.view', compact('data'));
    }

    public function insert(Request $request){
      $this->validate($request,[
          'name'=>'required|unique:income_categories,in_cat_name'
        ],[
          'name.required'=>'Please enter Income Category name!',
        ]);
        $slug = Str::slug($request->name, '-');
        $creator=Auth::user()->id;
        $insert=IncomeCategory::insertGetId([
          'in_cat_name'=>$request['name'],
          'in_cat_remarks'=>$request['remarks'],
          'in_cat_creator'=>$creator,
          'in_cat_slug'=>$slug,
          'created_at'=>carbon::now('Asia/Dhaka')->toDateTimeString(),
        ]);
        if($insert){
           Session::flash('success');
           return redirect('dashboard/income/category');
       }else{
           return redirect('dashboard/income/category/add');
           Session::flash('error');
       }
    }

    public function update(Request $request){
      $id= $request['id'];
      $this->validate($request,[
          'name'=>'required|unique:income_categories,in_cat_name,'.$id.',in_cat_id'
        ],[
          'name.required'=>'Please enter Income Category name!',
        ]);
        $creator=Auth::user()->id;
        $slug = Str::slug($request->name, '-');
        $update=IncomeCategory::where('in_cat_status',1)->where('in_cat_id',$id)->update([
          'in_cat_name'=>$request['name'],
          'in_cat_remarks'=>$request['remarks'],
          'in_cat_creator'=>$creator,
          'in_cat_slug'=>$slug,
          'updated_at'=>carbon::now('Asia/Dhaka')->toDateTimeString(),
        ]);
        if($update){
           Session::flash('upSuccess');
           return redirect('dashboard/income/category');
       }else{
           return redirect('dashboard/income/category/edit');
           Session::flash('error');
       }
    }

    public function softdelete(){
      $id=$_POST['modal_id'];
      $soft=IncomeCategory::where('in_cat_status',1)->where('in_cat_id',$id)->update([
        'in_cat_status'=>'0',
      ]);
      if($soft){
        Session::flash('softSuccess');
        return redirect('dashboard/income/category');
    }else{
        return redirect('dashboard/income/category');
        Session::flash('error');
      }
    }

    public function restore(){
      $id=$_POST['modal_id'];
      $soft=IncomeCategory::where('in_cat_status',0)->where('in_cat_id',$id)->update([
        'in_cat_status'=>1,
        'updated_at'=>Carbon::now()->toDateTimeString(),
      ]);

      if($soft){
        Session::flash('success','successfully restore income category information.');
        return back();
      }else{
        Session::flash('error','please try again.');
        return back();
      }
    }

    public function delete(){
      $id=$_POST['modal_id'];
      $del=IncomeCategory::where('in_cat_status',0)->where('in_cat_id',$id)->delete([]);

      if($del){
        Session::flash('success','successfully delete income category information permanently.');
        return back();
      }else{
        Session::flash('error','please try again.');
        return back();
      }
    }
}
