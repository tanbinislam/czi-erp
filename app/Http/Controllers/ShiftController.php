<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DailyShift;
use Carbon\Carbon;
use Session;
use Image;
use Auth;

class ShiftController extends Controller
{
    public function __construct(){
      $this->middleware('auth');
    }

    public function index(){
       $all=DailyShift::where('status',1)->orderBy('id')->get();
       return view('admin.shift.all',compact('all'));
    }

    public function add(){
       return view('admin.shift.add');
    }

    public function edit($id){
      $data=DailyShift::where('status',1)->where('id',$id)->firstOrFail();
       return view('admin.shift.edit',compact('data'));
    }

    public function shiftInfo($id){
       $data=DailyShift::where('status',1)->where('id',$id)->firstOrFail();
       return response()->json(['shift' => $data]);
    }


    public function insert(Request $request){

        $this->validate($request,[
            'title'=>'required|unique:daily_shifts,title',
            'time'=>'required',
            'to_time'=>'required',
        ],[
            'title.required'=>'Please enter title!',
            'time.required'=>'Please enter shift in time!',
            'to_time.required'=>'Please enter shift end time!',
        ]);
        $insert= DailyShift::insertGetId([
            'title'=>$request->title,
            'time'=> date('H:i',strtotime( $request->time)),
            'to_time'=>date('H:i',strtotime( $request->to_time)),
            'created_at'=>carbon::now('Asia/Dhaka')->toDateTimeString(),
        ]);

        if($insert){
          Session::flash('success','successfully add shift information.');
          return redirect('dashboard/shift');
        }else{
          Session::flash('error','please try again.');
          return redirect('dashboard/shift/add');
        }
    }


    public function update(Request $request){
         $id = $request->id;
        $this->validate($request,[
            'title'=>'required|unique:daily_shifts,title,'.$id.',id',
            'time'=>'required',
            'to_time'=>'required',
        ],[
            'title.required'=>'Please enter title!',
            'time.required'=>'Please enter shift in time!',
            'to_time.required'=>'Please enter shift end time!',
        ]);
        $update= DailyShift::where('id',$id)->update([
            'title'=>$request->title,
            'time'=> date('H:i',strtotime( $request->time)),
            'to_time'=>date('H:i',strtotime( $request->to_time)),
            'updated_at'=>carbon::now('Asia/Dhaka')->toDateTimeString(),
        ]);

        if($update){
          Session::flash('upSuccess','successfully update shift information.');
          return redirect('dashboard/shift');
        }else{
          Session::flash('error','please try again.');
          return redirect()->back();
        }
    }

    public function softDelete(Request $request)
    {
      $data = DailyShift::where('status', 1)->where('id', $request->modal_id)->sole();
      $data->status = 0;
      $data->save();

      Session::flash('success','successfully soft deleted shift information.');
      return back();

    }

    public function restore(Request $request)
    {
      $data = DailyShift::where('status', 0)->where('id', $request->modal_id)->sole();
      $data->status = 1;
      $data->save();

      Session::flash('softSuccess','successfully restored shift information.');
      return back();
    }

    public function delete(Request $request)
    {
      $data = DailyShift::where('status', 0)->where('id', $request->modal_id)->sole();
      $data->delete();

      Session::flash('softSuccess','successfully deleted shift information.');
      return back();
    }

}
