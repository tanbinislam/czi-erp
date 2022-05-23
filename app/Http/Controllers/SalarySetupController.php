<?php

namespace App\Http\Controllers;

use App\Http\Requests\SalarySetupRequest;
use App\Models\Employee;
use App\Models\SalarySetup;
use App\Models\SalaryType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class SalarySetupController extends Controller
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
        $all = SalarySetup::with('employees')->where('status', 1)->get();
        return view('admin.payroll.salary-setup.all',compact('all'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $employees = Employee::with('official')->where('employee_status',1)->get();
        $salaryTypes = SalaryType::where('status',1)->get();
        return view('admin.payroll.salary-setup.add',compact('employees','salaryTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|unique:salary_setups',
            'gross_salary' => 'required',
        ],[
            'employee_id.required' => 'The employee name field is required.',
            'gross_salary.required' => 'The gross salary field is required.',
        ]);
        
        $insert =  SalarySetup::create([
            'employee_id' => $request->employee_id,
            'salary_type' => $request->salary_type,
            'is_percentage' => $request->is_percentage,
            'gross_salary' => $request->gross_salary,
        ]);

        if ($insert) {
            Session::flash('success', 'successfully add salary setup information.');
            return redirect('dashboard/payroll/salary_setup');
        } else {
            Session::flash('error', 'please try again.');
            return redirect('dashboard/payroll/salary_setup');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SalarySetup  $salarySetup
     * @return \Illuminate\Http\Response
     */
    public function edit(SalarySetup $salarySetup)
    {
        //return $salarySetup;
        $employees = Employee::with('official')->where('employee_status',1)->get();
        $salaryTypes = SalaryType::where('status',1)->get();
        return view('admin.payroll.salary-setup.edit',compact('employees','salaryTypes','salarySetup'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SalarySetup  $salarySetup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SalarySetup $salarySetup)
    {
        $request->validate([
            'employee_id' => ['required', Rule::unique('salary_setups')->ignore($salarySetup)],
            'gross_salary' => 'required',
        ],[
            'employee_id.required' => 'The employee name field is required.',
            'gross_salary.required' => 'The gross salary field is required.',
        ]);

        $insert =  $salarySetup->update([
            'employee_id' => $request->employee_id,
            'salary_type' => $request->salary_type,
            'is_percentage' => $request->is_percentage,
            'gross_salary' => $request->gross_salary,
        ]);

        if ($insert) {
            Session::flash('success', 'successfully add salary setup information.');
            return redirect('dashboard/payroll/salary_setup');
        } else {
            Session::flash('error', 'please try again.');
            return redirect('dashboard/payroll/salary_setup');
        }
    }

    public function softDelete(Request $request)
    {
        // dd($request);
        $data = SalarySetup::where('status', 1)->where('id', $request->modal_id)->sole();
        $data->status = 0;
        $data->save();

        Session::flash('softSuccess','successfully soft deleted shift information.');
        return back();

    }

    public function restore(Request $request)
    {
      $data = SalarySetup::where('status', 0)->where('id', $request->modal_id)->sole();
      $data->status = 1;
      $data->save();

      Session::flash('softSuccess','successfully restored shift information.');
      return back();
    }

    public function delete(Request $request)
    {
      $data = SalarySetup::where('status', 0)->where('id', $request->modal_id)->sole();
      $data->delete();

      Session::flash('softSuccess','successfully deleted shift information.');
      return back();
    }


}
