<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class RecycleController extends Controller{
    public function __construct(){
      $this->middleware('auth');
    }

    public function index(){
      return view('admin.recycle.index');
    }

    public function user(){
      return view('admin.recycle.user');
    }

    public function income(){
      return view('admin.recycle.income');
    }

    public function expense(){
      return view('admin.recycle.expense');
    }

    public function incomeCat(){
      return view('admin.recycle.income-category');
    }

    public function expenseCat(){
      return view('admin.recycle.expense-category');
    }

    public function employee(){
      return view('admin.recycle.employee');
    }

    public function department(){
      return view('admin.recycle.department');
    }

    public function designation(){
      return view('admin.recycle.designation');
    }

    public function dailyShift(){
      return view('admin.recycle.shift');
    }

    public function employeeAttendance(){
      return view('admin.recycle.attendance');
    }

    public function employeeEducation(){
      return view('admin.recycle.employee-education');
    }

    public function employeeLeave(){
      return view('admin.recycle.employee-leave');
    }

    public function salaryType(){
      return view('admin.recycle.salary-type');
    }

    public function salarySetup(){
      return view('admin.recycle.salary-setup');
    }

    public function employeePayment(){
      return view('admin.recycle.employee-payment');
    }

    public function material(){
      return view('admin.recycle.material');
    }

    public function materialPurchase(){
      return view('admin.recycle.material-purchase');
    }

    public function materialDamage(){
      return view('admin.recycle.material-damage');
    }

    public function recipe(){
      return view('admin.recycle.recipe');
    }

    public function recipeProduct(){
      return view('admin.recycle.recipe-product');
    }

    public function madeRecipeProduct(){
      return view('admin.recycle.make-recipe-product');
    }

    public function customer(){
      return view('admin.recycle.customer');
    }

    public function supplier(){
      return view('admin.recycle.supplier');
    }
}
