<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Income;
use App\Models\Expense;
use Carbon\Carbon;
use Session;
use Auth;

class IncomeExpenseSummaryController extends Controller{
  public function __construct(){
    $this->middleware('auth');
  }

  public function index(){
    $incomes =  Income::where('income_status', '=', 1)->orderBy('income_date','DESC')->get();
    $incomeTotal =  Income::where('income_status', '=', 1)->sum('income_amount');
    $expense =  Expense::where('expens_status', '=', 1)->orderBy('expens_date','DESC')->get();
    $expenseTotal =  Expense::where('expens_status', '=', 1)->sum('expens_amount');
    return view('admin.summary.all', compact('incomes','expense','incomeTotal','expenseTotal'));
  }

  public function search($from,$to){
    $incomes = Income::whereBetween('income_date', [$from, $to])->where('income_status', '=', 1)->get();
    $expense = Expense::whereBetween('expens_date', [$from, $to])->where('expens_status', '=', 1)->get();
    $incomeTotal =  Income::whereBetween('income_date', [$from, $to])->where('income_status', '=', 1)->sum('income_amount');
    $expenseTotal =  Expense::whereBetween('expens_date', [$from, $to])->where('expens_status', '=', 1)->sum('expens_amount');
    return view('admin.summary.search', compact('from','to','incomes','expense','incomeTotal','expenseTotal'));
  }
}
