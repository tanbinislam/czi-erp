<?php

namespace App\Http\Controllers;

use App\Http\Requests\SalaryTypeRequest;
use App\Models\SalaryType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SalaryTypeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = SalaryType::where('status', 1)->get();
        return view('admin.payroll.salary-type.all',compact('all'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $add= SalaryType::ADD;
       $deduct= SalaryType::DEDUCT;
        return view('admin.payroll.salary-type.add',compact('add','deduct'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SalaryTypeRequest $request)
    {

       $insert = SalaryType::create($request->all());

        if ($insert) {
            Session::flash('success', 'successfully add salary type information.');
            return redirect('dashboard/payroll/salary_type');
        } else {
            Session::flash('error', 'please try again.');
            return redirect('dashboard/payroll/salary_type');
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SalaryType  $salaryType
     * @return \Illuminate\Http\Response
     */
    public function edit(SalaryType $salaryType)
    {
        $add= SalaryType::ADD;
        $deduct= SalaryType::DEDUCT;
        return view('admin.payroll.salary-type.edit',compact('add','deduct','salaryType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SalaryType  $salaryType
     * @return \Illuminate\Http\Response
     */
    public function update(SalaryTypeRequest $request, SalaryType $salaryType)
    {
        $insert = $salaryType->update($request->all());

        if ($insert) {
            Session::flash('success', 'successfully update salary type information.');
            return redirect('dashboard/payroll/salary_type');
        } else {
            Session::flash('error', 'please try again.');
            return redirect('dashboard/payroll/salary_type');
        }
    }

    public function softDelete(Request $request)
    {
        // dd($request);
        $data = SalaryType::where('status', 1)->where('id', $request->modal_id)->sole();
        $data->status = 0;
        $data->save();

        Session::flash('softSuccess','successfully soft deleted shift information.');
        return back();

    }

    public function restore(Request $request)
    {
      $data = SalaryType::where('status', 0)->where('id', $request->modal_id)->sole();
      $data->status = 1;
      $data->save();

      Session::flash('softSuccess','successfully restored shift information.');
      return back();
    }

    public function delete(Request $request)
    {
      $data = SalaryType::where('status', 0)->where('id', $request->modal_id)->sole();
      $data->delete();

      Session::flash('softSuccess','successfully deleted shift information.');
      return back();
    }
}
