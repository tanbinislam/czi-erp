<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\OfficialInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class OfficialInformationController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($code)
    {
        $emp = Employee::with('official')->where('employee_status', 1)->where('employee_code', $code)->firstOrFail();
        return view('admin.employee.official-info.all', compact('emp'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\OfficialInformation $officialInformation
     * @return \Illuminate\Http\Response
     */
    public function show(OfficialInformation $officialInformation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\OfficialInformation $officialInformation
     * @return \Illuminate\Http\Response
     */
    public function edit(OfficialInformation $officialInformation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\OfficialInformation $officialInformation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $this->validate($request,[
            'salary'=>'required',
            'salary_type'=>'required',
        ]);

        $employee=$request['employee'];
        $code=$request['code'];
        $id=$request['id'];

        if (empty($id)) {
            $update = OfficialInformation::where('id',$id)->create([
                'employee_id'=>$employee,
                'salary'=>$request['salary'],
                'salary_type'=>$request['salary_type'],
                'joining_date'=>$request['joining_date'],
                'reference'=>$request['reference'],
                'created_at'=>Carbon::now()->toDateTimeString(),
            ]);
        }else{
            $update = OfficialInformation::where('id',$id)->update([
                'employee_id'=>$employee,
                'salary'=>$request['salary'],
                'salary_type'=>$request['salary_type'],
                'joining_date'=>$request['joining_date'],
                'reference'=>$request['reference'],
                'created_at'=>Carbon::now()->toDateTimeString(),
            ]);
        }

        if($update){
            Session::flash('success','successfully update official information.');
            return redirect('dashboard/'.$code.'/official-info');
        }else{
            Session::flash('error','please try again.');
            return redirect('dashboard/'.$code.'/official-info');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\OfficialInformation $officialInformation
     * @return \Illuminate\Http\Response
     */
    public function destroy(OfficialInformation $officialInformation)
    {
        //
    }
}
