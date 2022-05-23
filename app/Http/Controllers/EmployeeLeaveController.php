<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeLeave;
use Illuminate\Http\Request;

class EmployeeLeaveController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index($code)
    {
        $emp = Employee::where('employee_code',$code)->sole();
        $leaves = EmployeeLeave::where('status', 1)->where('employee_id', $emp->employee_id)->orderBy('created_at', 'DESC')->get();
        return view('admin.employee.leave.all', compact('emp', 'leaves'));
    }

    public function edit($code, $slug)
    {
        $emp = Employee::where('employee_code',$code)->sole();
        $leave = EmployeeLeave::where('status', 1)->where('employee_id', $emp->employee_id)->where('leave_slug', $slug)->sole();
        return view('admin.employee.leave.edit', compact('emp', 'leave'));
    }

    public function insert(Request $request)
    {
        // dd($request);
        $request->validate([
            'employee_id' => ['required'],
            'leave_from' => ['required'],
            'leave_to' => ['required'],
            'leave_reason' =>['required'],
        ],[
            'employee_id.required' => 'Employee is required!',
            'leave_from.required' => 'Starting date is required!',
            'leave_to.required' => 'Ending date is required!',
            'leave_reason.required' => 'Leave reason is required!',
        ]);

        $slug = 'EL-'.uniqid();
        EmployeeLeave::create([
            'employee_id' => $request->employee_id,
            'leave_from' => $request->leave_from,
            'leave_to' => $request->leave_to,
            'leave_reason' => $request->leave_reason,
            'leave_slug' => $slug,
            'status' => 1,
        ]);

        session()->flash('success', 'Successfuly Added Leave Information');
        return redirect('dashboard/employee/'.$request->code.'/leave');
    }

    public function update(Request $request)
    {
        $request->validate([
            'leave_from' => ['required'],
            'leave_to' => ['required'],
            'leave_reason' =>['required'],
        ],[
            'leave_from.required' => 'Starting date is required!',
            'leave_to.required' => 'Ending date is required!',
            'leave_reason.required' => 'Leave reason is required!',
        ]);

        $leave = EmployeeLeave::where('leave_slug', $request->slug)->sole();
        $leave->leave_from = $request->leave_from;
        $leave->leave_to = $request->leave_to;
        $leave->leave_reason = $request->leave_reason;
        $leave->save();

        session()->flash('success', 'Successfuly Updated Leave Information');
        return redirect('dashboard/employee/'.$request->code.'/leave');
    }

    public function softDelete(Request $request)
    {
        $leave = EmployeeLeave::where('status', 1)->where('id', $request->modal_id)->sole();
        $leave->status = 0;
        $leave->save();

        session()->flash('success', 'Successfuly Soft Deleted Leave Information');
        return redirect('dashboard/employee/'.$request->code.'/leave');
    }

    public function restore(Request $request)
    {
        $leave = EmployeeLeave::where('status', 0)->where('id', $request->modal_id)->sole();
        $leave->status = 1;
        $leave->save();

        session()->flash('success', 'Successfuly Restored Leave Information');
        return back();
    }

    public function delete(Request $request)
    {
        $leave = EmployeeLeave::where('status', 0)->where('id', $request->modal_id)->sole();
        $leave->delete();

        session()->flash('success', 'Successfuly Deleted Leave Information');
        return back();
    }


}
