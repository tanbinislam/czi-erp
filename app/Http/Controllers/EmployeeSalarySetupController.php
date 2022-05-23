<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\SalaryType;
use Illuminate\Http\Request;

class EmployeeSalarySetupController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function getSalaryType(Request $request)
    {
        $employee = Employee::with('official')->where('employee_id', $request->employee_id)->where('employee_status', 1)->first();
        $salaryType = SalaryType::where('status', 1)->get();
        return response()->json([
            'success' => true,
            'data' => $employee,
            'salaryType' => $salaryType,
        ]);
    }

}
