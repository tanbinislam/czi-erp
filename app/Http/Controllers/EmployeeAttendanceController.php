<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeAttendanceRequest;
use App\Models\DailyShift;
use App\Models\Employee;
use App\Models\EmployeeAttendance;
use App\Models\Holiday;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class EmployeeAttendanceController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index()
    {
        $all = EmployeeAttendance::with('employee')->where('status', 1)->orderBy('date', 'DESC')->get();
        return view('admin.employee.attendance.all', compact('all'));
    }

    
    public function create()
    {
        $employees = Employee::where('employee_status', 1)->get();
        $shifts = DailyShift::where('status', 1)->get();
        return view('admin.employee.attendance.add', compact('employees', 'shifts'));
    }

    
    public function store(Request $request)
    {
        // dd($request);
        $this->validate($request,[
            'employee_id'=>['required'],
            'employee_id.*'=>['nullable', Rule::unique('employee_attendances', 'employee_id')->where(fn ($query) => $query->where('date', $request->date))],
            'shift_id'=>'required',
            'shift_id.*'=> 'nullable|required_with:employee_id.*',
            'intime' => 'required',
            'intime.*' => 'nullable|required_with:employee_id.*',
            'outtime' => 'required',
            'outtime.*' => 'nullable|required_with:employee_id.*',
            'date' => 'required',
        ],[
            'employee_id.required'=>'Please select employee name!',
            'employee_id.*.unique' => 'This employee\'s attendance has already been registered.',
            'shift_id.*.required_with'=>'Please select Shift!',
            'intime.*.required_with'=>'Please set in time!',
            'outtime.*.required_with'=>'Please set out time!',
            'date.required'=>'Attendance date is required!',
        ]);

        $holidays = Holiday::holidays(date('Y', strtotime($request->date)));

        $is_holiday = $holidays->where('date', date('Y-m-d', strtotime($request->date)))->count() > 0 || date('N', strtotime($request->date)) == 5;

        foreach ($request->employee_id as $key => $val) {
            $shift = DailyShift::findOrFail($request->shift_id[$key]);

            if($request->intime[$key] > $request->outtime[$key]){
                $attended_hour = date_diff(date_create(date('Y-m-d', time()).$request->intime[$key]), date_create(date('Y-m-d', strtotime('tomorrow')).$request->outtime[$key]));
            }else{
                $attended_hour = date_diff(date_create(date('Y-m-d', time()).$request->intime[$key]), date_create(date('Y-m-d', time()).$request->outtime[$key]));
            }

            if($shift->time > $shift->to_time){
                $shift_hour = date_diff(date_create(date('Y-m-d', time()).$shift->time), date_create(date('Y-m-d', strtotime('tomorrow')).$shift->to_time));
            }else{
                $shift_hour = date_diff(date_create(date('Y-m-d', time()).$shift->time), date_create(date('Y-m-d', time()).$shift->to_time));
            }
            
            // dd(($attended_hour->h * 60) + $attended_hour->i , ($shift_hour->h)*60 + $shift_hour->i);
            if((($attended_hour->h * 60) + $attended_hour->i - ($shift_hour->h)*60 + $shift_hour->i) <= 0){
                $overtime = 0;
            }else{
                $overtime = (($attended_hour->h - ($shift_hour->h)) * 60) + ($attended_hour->i - $shift_hour->i);
            }

            $employee = Employee::where('employee_status', 1)->where('employee_id', $request->employee_id[$key])->firstOrFail();

            $insert = EmployeeAttendance::create([
                'date' => $request->date,
                'employee_id' => $request->employee_id[$key],
                'intime' => $request->intime[$key],
                'outtime' => $request->outtime[$key],
                'shift_id' => $request->shift_id[$key],
                'status' => 1,
                'overtime' => $is_holiday ? ($employee->official->salary_type == 'Daily' ? $overtime : (($attended_hour->h * 60) + $attended_hour->i) ) : $overtime,
                'is_holiday' =>  $is_holiday ? 1 : 0,
            ]);
        }

        if ($insert) {
            Session::flash('success', 'successfully add employee attendance information.');
            return redirect('dashboard/attendance/');
        } else {
            Session::flash('error', 'please try again.');
            return redirect('dashboard/attendance/');
        }

    }

    
    public function edit(EmployeeAttendance $employeeAttendance)
    {
        return view('admin.employee.attendance.edit', compact('employeeAttendance'));
    }

    
    public function update(Request $request, EmployeeAttendance $employeeAttendance)
    {
    
        $holidays = Holiday::holidays(date('Y', strtotime($employeeAttendance->date)));

        $is_holiday = $holidays->where('date', date('Y-m-d', strtotime($employeeAttendance->date)))->count() > 0 || date('N', strtotime($employeeAttendance->date)) == 5;
        $shift = DailyShift::findOrFail($employeeAttendance->shift_id);

        if($request->intime > $request->outtime){
            $attended_hour = date_diff(date_create(date('Y-m-d', time()).$request->intime), date_create(date('Y-m-d', strtotime('tomorrow')).$request->outtime));
        }else{
            $attended_hour = date_diff(date_create(date('Y-m-d', time()).$request->intime), date_create(date('Y-m-d', time()).$request->outtime));
        }

        if($shift->time > $shift->to_time){
            $shift_hour = date_diff(date_create(date('Y-m-d', time()).$shift->time), date_create(date('Y-m-d', strtotime('tomorrow')).$shift->to_time));
        }else{
            $shift_hour = date_diff(date_create(date('Y-m-d', time()).$shift->time), date_create(date('Y-m-d', time()).$shift->to_time));
        }

        if((($attended_hour->h * 60) + $attended_hour->i - ($shift_hour->h)*60 + $shift_hour->i) <= 0){
            $overtime = 0;
        }else{
            $overtime = (($attended_hour->h - ($shift_hour->h)) * 60) + ($attended_hour->i - $shift_hour->i);
        }
        $employee = Employee::where('employee_status', 1)->where('employee_id', $employeeAttendance->employee_id)->firstOrFail();   
        $employeeAttendance->intime = $request->intime;
        $employeeAttendance->outtime = $request->outtime;
        $employeeAttendance->overtime = $is_holiday ? ($employee->official->salary_type == 'Daily' ? $overtime : (($attended_hour->h * 60) + $attended_hour->i) ) : $overtime;
        $employeeAttendance->is_holiday = $is_holiday ? 1 : 0;
        $employeeAttendance->save();   
        
        Session::flash('success', 'successfully add employee attendance update information.');
        return redirect('dashboard/attendance/');
        
    }

   
    public function softDelete(Request $request)
    {
      $data = EmployeeAttendance::where('status', 1)->where('id', $request->modal_id)->sole();
      $data->status = 0;
      $data->save();

      Session::flash('success','successfully soft deleted attandance information.');
      return back();

    }

    public function restore(Request $request)
    {
      $data = EmployeeAttendance::where('status', 0)->where('id', $request->modal_id)->sole();
      $data->status = 1;
      $data->save();

      Session::flash('softSuccess','successfully restored attendance information.');
      return back();
    }

    public function delete(Request $request)
    {
      $data = EmployeeAttendance::where('status', 0)->where('id', $request->modal_id)->sole();
      $data->delete();

      Session::flash('softSuccess','successfully deleted attendance information.');
      return back();
    }



    public function singleEmployeeAttendance($employee)
    {

        // $employee = Employee::with('attendances')->where('employee_code',$employee)->get();
        $emp = Employee::with('attendances')->where('employee_status', 1)->where('employee_code', $employee)->firstOrFail();

        return view('admin.employee.attendance.daily-attendance.all', compact('emp'));
    }

    public function outTimeEmployeeAll(Request $request)
    {
        if ($request->date) {
            $employees  = EmployeeAttendance::where('date',$request->date)->with('employee')->get();
        }else{
            $employees = EmployeeAttendance::with('employee')->get();
        }
        $shifts = DailyShift::where('status', 1)->get();
        return view('admin.employee.attendance.daily-attendance.update', compact('employees', 'shifts'));
    }

    public function outTimeEmployeeAllUpdate(Request $request)
    {
        // dd($request);
        $this->validate($request,[
            'outtime.*'=>'required',
        ],[
            'outtume.*.required'=>'Please Enter Out Time!',
        ]);
        foreach ($request->att_id as $key => $val) {
            $employeeAttendance = EmployeeAttendance::findOrFail($request->att_id[$key]);
            $employee = Employee::where('employee_status', 1)->where('employee_id', $employeeAttendance->employee_id)->firstOrFail();
            $holidays = Holiday::holidays(date('Y', strtotime($employeeAttendance->date)));
            $is_holiday = $holidays->where('date', date('Y-m-d', strtotime($employeeAttendance->date)))->count() > 0 || date('N', strtotime($employeeAttendance->date)) == 5;
            $shift = DailyShift::findOrFail($employeeAttendance->shift_id);

            if($employeeAttendance->intime > $request->outtime[$key]){
                $attended_hour = date_diff(date_create(date('Y-m-d', time()).$employeeAttendance->intime), date_create(date('Y-m-d', strtotime('tomorrow')).$request->outtime[$key]));
            }else{
                $attended_hour = date_diff(date_create(date('Y-m-d', time()).$employeeAttendance->intime), date_create(date('Y-m-d', time()).$request->outtime[$key]));
            }

            if($shift->time > $shift->to_time){
                $shift_hour = date_diff(date_create(date('Y-m-d', time()).$shift->time), date_create(date('Y-m-d', strtotime('tomorrow')).$shift->to_time));
            }else{
                $shift_hour = date_diff(date_create(date('Y-m-d', time()).$shift->time), date_create(date('Y-m-d', time()).$shift->to_time));
            }

            if((($attended_hour->h * 60) + $attended_hour->i - ($shift_hour->h)*60 + $shift_hour->i) <= 0){
                $overtime = 0;
            }else{
                $overtime = (($attended_hour->h - ($shift_hour->h)) * 60) + ($attended_hour->i - $shift_hour->i);
            }

        
            
            $employeeAttendance->outtime = $request->outtime[$key];
            $employeeAttendance->overtime = $is_holiday ? ($employee->official->salary_type == 'Daily' ? $overtime : (($attended_hour->h * 60) + $attended_hour->i) ) : $overtime;
            $employeeAttendance->is_holiday = $is_holiday ? 1 : 0;
            $employeeAttendance->save();
        }

        Session::flash('success', 'successfully add employee attendance information.');
        return redirect('dashboard/attendance/');

    }
}
