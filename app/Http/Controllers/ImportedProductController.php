<?php

namespace App\Http\Controllers;

use App\Models\ImportedProduct;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Image;
use Auth;

class ImportedProductController extends Controller
{
    public function index()
    {
        $all = ImportedProduct::where('status', 1)->get();
        return view('admin.imported-product.all', compact('all'));
    }

    public function add()
    {
        return view('admin.imported-product.add');
    }

    public function edit($slug)
    {
        $data = ImportedProduct::where('status', 1)->where('slug', $slug)->sole();
        return view('admin.imported-product.edit', compact('data'));
    }

    public function view($slug)
    {
        $data = ImportedProduct::where('status', 1)->where('slug', $slug)->sole();
        return view('admin.imported-product.view', compact('data'));
    }

    public function insert(Request $request)
    {
        $request->validate([
            'name'=>'required',
          ],[
            'name.required'=>'Please enter product name!',
          ]);

          $slug='imp_pro_'.uniqid();

          $creator=auth()->user()->id;

          $insert=ImportedProduct::insertGetId([
            'name'=>$request['name'],
            'remarks'=>$request['remarks'],
            'creator'=>$creator,
            'slug'=>$slug,
            'created_at'=>Carbon::now('Asia/Dhaka')->toDateTimeString(),
          ]);

          if($request->hasFile('pic')){
            $image=$request->file('pic');
            $imageName='product_'.$insert.'_'.time().'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(200,200)->save('uploads/imported-product/'.$imageName);
            ImportedProduct::where('id',$insert)->update([
              'photo'=>$imageName,
            ]);
          }
          if($insert){
             Session::flash('success');
             return redirect('dashboard/imported-product');
         }else{
             return redirect('dashboard/imported-product/add');
             Session::flash('error');
         }
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'=>'required',
          ],[
            'name.required'=>'Please enter product name!',
          ]);

          $id=$request['id'];

          $creator=auth()->user()->id;

          $update=ImportedProduct::where('status',1)->where('id',$id)->update([
            'name'=>$request['name'],
            'remarks'=>$request['remarks'],
            'creator'=>$creator,
            'updated_at'=>Carbon::now('Asia/Dhaka')->toDateTimeString(),
          ]);
          if($request->hasFile('pic')){
            $image=$request->file('pic');
            $imageName='product_'.$id.'_'.time().'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(200,200)->save('uploads/imported-product/'.$imageName);
            ImportedProduct::where('id',$id)->update([
              'photo'=>$imageName,
            ]);
          }
          if($update){
             Session::flash('upSuccess');
             return redirect('dashboard/imported-product');
         }else{
             return redirect('dashboard/imported-product/edit');
             Session::flash('error');
         }
    }

    public function softdelete(Request $request)
    {
        // dd($request);
        $id=$_POST['modal_id'];

        $soft = ImportedProduct::where('status',1)->where('id',$id)->update(['status'=>'0']);

        if($soft){
            Session::flash('softSuccess');
            return redirect('dashboard/imported-product');
        }else{
            return redirect('dashboard/imported-product');
            Session::flash('error');
        }
    }

    public function restore(Request $request)
    {
        $data = ImportedProduct::where('status', 0)->where('id', $request->modal_id)->sole();
        $data->status = 1;
        $data->save();

        Session::flash('success','successfully restored product information.');
        return back();
    }

    public function delete(Request $request)
    {
        $data = ImportedProduct::where('status', 0)->where('id', $request->modal_id)->sole();
        $data->delete();

        Session::flash('success','successfully deleted product information.');
        return back();
    }
}
