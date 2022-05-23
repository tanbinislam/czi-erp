<?php

namespace App\Http\Controllers;

use App\Http\Requests\SalaryGenerateRequest;
use App\Models\SalaryGenerate;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class SalaryGenerateController extends Controller
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
        $all = SalaryGenerate::with('generateBy')->get();
        return view('admin.payroll.salary-generate.add',compact('all'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SalaryGenerateRequest $request)
    {

        $insert = SalaryGenerate::create([
            'name'=> Carbon::createFromFormat('m/yy', $request->name)
                ->format('yy-m'),
            'generate_date'=> Carbon::today(),
            'employee_id'=> auth()->user()->id,
        ]);
        if ($insert) {
            Session::flash('success', 'successfully add salary generate information.');
            return redirect('dashboard/payroll/create_salary_generate');
        } else {
            Session::flash('error', 'please try again.');
            return redirect('dashboard/payroll/create_salary_generate');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SalaryGenerate  $salaryGenerate
     * @return \Illuminate\Http\Response
     */
    public function show(SalaryGenerate $salaryGenerate)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SalaryGenerate  $salaryGenerate
     * @return \Illuminate\Http\Response
     */
    public function edit(SalaryGenerate $create_salary_generate)
    {
        $salaryGenerate = $create_salary_generate;
        return view('admin.payroll.salary-generate.edit',compact('salaryGenerate'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SalaryGenerate  $salaryGenerate
     * @return \Illuminate\Http\Response
     */
    public function update(SalaryGenerateRequest $request, SalaryGenerate $create_salary_generate)
    {
        $salaryGenerate = $create_salary_generate;
        $insert = $salaryGenerate->update([
            'name'=>Carbon::createFromFormat('m/yy', $request->name)
                ->format('Y-m'),
            'generate_date'=> Carbon::today(),
            'employee_id'=> auth()->user()->id,
        ]);

        if ($insert) {
            Session::flash('success', 'successfully update salary generate information.');
            return redirect('dashboard/payroll/create_salary_generate');
        } else {
            Session::flash('error', 'please try again.');
            return redirect('dashboard/payroll/create_salary_generate');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SalaryGenerate  $salaryGenerate
     * @return \Illuminate\Http\Response
     */
    public function destroy(SalaryGenerate $salaryGenerate)
    {
        //
    }
}
