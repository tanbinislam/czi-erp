<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Employee;
use Carbon\Carbon;
use Session;
use Image;
use Auth;

class EmployeePersonalController extends Controller{
    public function __construct(){
      $this->middleware('auth');
    }

    public function index($code){
      $emp=Employee::where('employee_status',1)->where('employee_code',$code)->firstOrFail();
      return view('admin.employee.personal.overview',compact('emp'));
    }
}
