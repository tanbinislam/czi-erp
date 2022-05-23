<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeAttendance;
use App\Models\EmployeePaymentView;
use App\Models\Holiday;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class EmployeePaymentViewController extends Controller
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
        $all = EmployeePaymentView::with('employee', 'user')->where('status', 1)->get();
        return view('admin.payroll.employee-salary.all', compact('all'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employee::where('employee_status', 1)->get();
        return view('admin.payroll.employee-salary.add', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $employee = Employee::where('employee_status', 1)->where('employee_id', $request->employee_id)->first();
        // dd($request);
        $request->validate([
            'employee_id' => 'required',
            'salary_type' => 'required',
            'month' => ['nullable', 'required_if:salary_type,Salary', Rule::unique('employee_payment_views')->where(fn ($query) => $query->where('employee_id', $employee->employee_id))],
            'ds_date' => 'nullable|required_if:salary_type,Daily',
        ],[
            'month.unique' => 'Salary previously generated for this month!'
        ]);

        $insert = EmployeePaymentView::create([
            "employee_id" => $request->employee_id,
            "basic_salary" => $request->basic_salary,
            "month" => $request->month,
            "ds_date" => $request->ds_date,
            "bonus" => $request->bonus,
            'overtime_salary' => $request->overtime_salary,
            "total_salary" => $request->total_salary,
            "user_id" => auth()->user()->id,
            "status" => 1,
            "is_pay" => 0,
        ]);
        if ($insert) {
            Session::flash('success', 'successfully add Employee Salary Payment Information.');
            return redirect('dashboard/payroll/employee_payment_view');
        } else {
            Session::flash('error', 'please try again.');
            return redirect('dashboard/payroll/employee_payment_view');
        }

    }

    
    public function payslip(EmployeePaymentView $employeePaymentView)
    {
        $employee = Employee::with('salarySetups', 'official', 'salaryPayment', 'attendances')->where('employee_id', $employeePaymentView->employee_id)->where('employee_status', 1)->firstOrFail();
        return view('admin.payroll.payslip', compact('employee', 'employeePaymentView'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\EmployeePaymentView $employeePaymentView
     * @return \Illuminate\Http\Response
     */
    public function edit(EmployeePaymentView $employeePaymentView)
    {
        $employee = Employee::with('salarySetups', 'official', 'salaryPayment', 'attendances')->where('employee_id', $employeePaymentView->employee_id)->where('employee_status', 1)->firstOrFail();
        $dates = EmployeeAttendance::where('employee_id', $employee->employee_id)->whereNotIn('date', $employee->salaryPayment->pluck('ds_date'))->orderBy('date', 'ASC')->get();
        // dd($employee);
        return view('admin.payroll.employee-salary.edit', compact('employeePaymentView','employee', 'dates'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\EmployeePaymentView $employeePaymentView
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmployeePaymentView $employeePaymentView)
    {
        // dd($request);
        $request->validate([
            'employee_id' => 'required',
            'salary_type' => 'required',
            'month' => ['nullable', 'required_if:salary_type,Salary', Rule::unique('employee_payment_views', 'month')->ignore($employeePaymentView)],
            'ds_date' => 'nullable|required_if:salary_type,Daily',
        ]);


        $insert = $employeePaymentView->update([
            "employee_id" => $request->employee_id,
            "basic_salary" => $request->basic_salary,
            "month" => $request->month,
            "ds_date" => $request->ds_date,
            "bonus" => $request->bonus,
            'overtime_salary' => $request->overtime_salary,
            "total_salary" => $request->total_salary,
            "user_id" => auth()->user()->id,
            "status" => 1,
            "is_pay" => 0,
        ]);
        if ($insert) {
            Session::flash('success', 'successfully update Employee Salary Payment Information.');
            return redirect('dashboard/payroll/employee_payment_view');
        } else {
            Session::flash('error', 'please try again.');
            return redirect('dashboard/payroll/employee_payment_view');
        }
    }

    public function softDelete(Request $request)
    {
        // dd($request);
        $data = EmployeePaymentView::where('status', 1)->where('id', $request->modal_id)->sole();
        $data->status = 0;
        $data->save();

        Session::flash('softSuccess','successfully soft deleted payment information.');
        return back();

    }

    public function restore(Request $request)
    {
      $data = EmployeePaymentView::where('status', 0)->where('id', $request->modal_id)->sole();
      $data->status = 1;
      $data->save();

      Session::flash('softSuccess','successfully restored payment information.');
      return back();
    }

    public function delete(Request $request)
    {
      $data = EmployeePaymentView::where('status', 0)->where('id', $request->modal_id)->sole();
      $data->delete();

      Session::flash('softSuccess','successfully deleted payment information.');
      return back();
    }


    public function getSalarySetup(Request $request)
    {

        $employee = Employee::with('salarySetups', 'official', 'salaryPayment', 'attendances')->where('employee_id', $request->employee_id)->where('employee_status', 1)->firstOrFail();
        $dates = EmployeeAttendance::where('employee_id', $employee->employee_id)->whereNotIn('date', $employee->salaryPayment->pluck('ds_date'))->orderBy('date', 'ASC')->get();
        // dd($dates);
        return response()->json([
            'success' => true,
            'data' => $employee,
            'dates' => $dates->pluck('date')
        ]);
    }

    public function paySalarySetup(Request $request)
    {
      //  $employee = Employee::with('salarySetups', 'official','salaryPayment')->where('employee_id', $request->id)->where('employee_status', 1)->firstOrFail();
        $employee = EmployeePaymentView::with('employee')->where('id',$request->id)->where("status",1)->first();
       return response()->json([
            'success' => true,
            'data' => $employee
        ]);

    }

    public function updatePayment(Request $request)
    {

        $this->validate($request,[
            'payment_type' => 'required',
            
            ]);
        $employeePayment= EmployeePaymentView::with('employee')->where('id',$request->id)->where("status",1)->first();
        $insert =  $employeePayment->update([
            'payment_type' => $request->payment_type,
            'is_pay' => 1
        ]);

        if ($insert) {
            Session::flash('success', 'successfully Employee Salary Payment Paid Information.');
            return redirect('dashboard/payroll/employee_payment_view');
        } else {
            Session::flash('error', 'please try again.');
            return redirect('dashboard/payroll/employee_payment_view');
        }
    }

    public function getOverTime(Request $request)
    {
        $employee = Employee::where('employee_status', 1)->where('employee_id', $request->employee_id)->firstOrFail();
        $salary_type = $employee->official->salary_type;
        $salary = $employee->official->salary;

        $salary_hourly = $salary_type == 'Salary' ? $salary / 300 : $salary / 10;
        $salary_per_minute = $salary_hourly / 60;
        // $overtime = '';
        if($salary_type == 'Salary'){
            $starting_date = date('Y-m-01', strtotime($request->date.'-01'));
            $ending_date = date('Y-m-t', strtotime($request->date.'-01'));
            // dd($request);
            $overtime = EmployeeAttendance::where('employee_id', $request->employee_id)->whereBetween('date', [date('Y-m-d', strtotime($starting_date)), date('Y-m-d', strtotime($ending_date))])->sum('overtime') * $salary_per_minute;
        }

        if($salary_type == 'Daily'){
            $overtime = EmployeeAttendance::where('employee_id', $request->employee_id)->where('date', date('Y-m-d',strtotime($request->date)))->sum('overtime') * $salary_per_minute;
        }

        return response()->json(['overtime' => $overtime]);
        
    }
}
