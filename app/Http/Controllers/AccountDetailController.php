<?php

namespace App\Http\Controllers;

use App\Models\AccountDetail;
use App\Models\CoustomerBuyProduct;
use App\Models\Customer;
use App\Models\CustomerPayment;
use App\Models\EmployeePaymentView;
use App\Models\Expense;
use App\Models\Income;
use App\Models\MadeRecipeProduct;
use App\Models\MaterialPurchase;
use App\Models\RecipeMake;
use App\Models\RecipeProduct;
use App\Models\SupplierPayment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AccountDetailController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $accounts = AccountDetail::orderBy('month', 'ASC')->get();
        return view('admin.finance-accounting.account-details.all', compact('accounts'));
    }
    
    public function edit($slug)
    {
        $account = AccountDetail::where('slug', $slug)->sole();
        return response()->json(['data' => $account]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'month' => ['required', 'unique:account_details'],
            'cash_in_banks' => ['required', 'numeric', "min:0"],
            'cash_in_boxes' => ['required', 'numeric', "min:0"],
            'fixed_assets' => ['required', 'numeric', "min:0"],
            'non_current_liabilities' => ['required', 'numeric', "min:0"],
        ],[
            'cash_in_banks.required' => 'Amount is Required.',
            'cash_in_boxes.required' => 'Amount is Required.',
            'fixed_assets.required' => 'Amount is Required.',
            'non_current_liabilities.required' => 'Amount is Required.',
            'cash_in_banks.numeric' =>'Amount must be number.',
            'cash_in_boxes.numeric' =>'Amount must be number.',
            'fixed_assets.numeric' =>'Amount must be number.',
            'non_current_liabilities.numeric' =>'Amount must be number.',
            'cash_in_banks.min' =>' Amount must be not less than 0.',
            'cash_in_boxes.min' =>' Amount must be not less than 0.',
            'fixed_assets.min' =>' Amount must be not less than 0.',
            'non_current_liabilities.min' =>' Amount must be not less than 0.',
        ]);
        $slug = 'AC-'.uniqid();
        AccountDetail::create([
            'month' => $request->month,
            'cash_in_banks' => $request->cash_in_banks,
            'cash_in_boxes' => $request->cash_in_boxes,
            'fixed_assets' => $request->fixed_assets,
            'non_current_liabilities' => $request->non_current_liabilities,
            'slug' => $slug,
        ]);

        session()->flash('success', '');
        return back();
    }

    public function update(Request $request, $slug)
    {
        $account = AccountDetail::where('slug', $slug)->sole();
        $request->validate([
            'month' => ['required', Rule::unique('account_details')->ignore($account)],
            'cash_in_banks' => ['required', 'numeric', "min:0"],
            'cash_in_boxes' => ['required', 'numeric', "min:0"],
            'fixed_assets' => ['required', 'numeric', "min:0"],
            'non_current_liabilities' => ['required', 'numeric', "min:0"],
        ],[
            'cash_in_banks.required' => 'Amount is Required.',
            'cash_in_boxes.required' => 'Amount is Required.',
            'fixed_assets.required' => 'Amount is Required.',
            'non_current_liabilities.required' => 'Amount is Required.',
            'cash_in_banks.numeric' =>'Amount must be number.',
            'cash_in_boxes.numeric' =>'Amount must be number.',
            'fixed_assets.numeric' =>'Amount must be number.',
            'non_current_liabilities.numeric' =>'Amount must be number.',
            'cash_in_banks.min' =>' Amount must be not less than 0.',
            'cash_in_boxes.min' =>' Amount must be not less than 0.',
            'fixed_assets.min' =>' Amount must be not less than 0.',
            'non_current_liabilities.min' =>' Amount must be not less than 0.',
        ]);

        $account->month = $request->month;
        $account->cash_in_banks = $request->cash_in_banks;
        $account->cash_in_boxes = $request->cash_in_boxes;
        $account->fixed_assets = $request->fixed_assets;
        $account->non_current_liabilities = $request->non_current_liabilities;
        $account->save();

        session()->flash('upSuccess', '');
        return back();
    }

    public function balanceSheet(Request $request)
    {
        $starting_date =  isset($_GET['from']) ? $_GET['from'] : date('Y-m-01', time());
        $ending_date = isset($_GET['from']) ? $_GET['to'] : date('Y-m-t', time());
        $account_data_by_date = AccountDetail::whereBetween('month', [date('Y-m', strtotime($starting_date)), date('Y-m', strtotime($ending_date))])->first();
        $account_data = is_null($account_data_by_date) ? AccountDetail::orderBy('month', 'DESC')->first() : $account_data_by_date;
        
        $cash_in_boxes = is_null($account_data) ? 0 : $account_data->cash_in_boxes;
        $cash_in_banks = is_null($account_data) ? 0 : $account_data->cash_in_banks;
        $fixed_assets = is_null($account_data) ? 0 : $account_data->fixed_assets;
        $non_current_liabilities = is_null($account_data) ? 0 : $account_data->non_current_liabilities;

        $customer_bought_product_total_prices = [];
        $customer_bought_product_paid_prices = [];

        $sold_products = CoustomerBuyProduct::whereBetween('purchase_date', [date('Y-m-d', strtotime($starting_date)), date('Y-m-d', strtotime($ending_date))])->get();
        foreach($sold_products as $product){
            $customer_bought_product_total_prices[] = $product->price * $product->quantity;
        }

        $customer_paid_amounts = CustomerPayment::whereBetween('date', [date('Y-m-d', strtotime($starting_date)), date('Y-m-d', strtotime($ending_date))])->get();
        foreach($customer_paid_amounts as $payment){
            $customer_bought_product_paid_prices[] = $payment->payable_amount;
        }

        $account_receivable = array_sum($customer_bought_product_total_prices) - array_sum($customer_bought_product_paid_prices);

        $material_purchase = MaterialPurchase::whereBetween('mp_date', [date('Y-m-d', strtotime($starting_date)), date('Y-m-d', strtotime($ending_date))])->get();
        $material_purchase_total_price = $material_purchase->sum('mp_total_price');
        $used_in_recipe = RecipeMake::whereIn('chalan_name', $material_purchase->unique('mp_chalan')->pluck('mp_chalan'))->get();
        $used_in_recipe_prices = [];
        foreach($used_in_recipe as $material){
            $material_price = $material_purchase->where('mp_chalan', $material->chalan_name)->where('material_id', $material->material_id)->first();
            $used_in_recipe_prices[] = $material_price->mp_unit_price * $material->quantity;
        }
        $material_inventory_total_price = $material_purchase_total_price - array_sum($used_in_recipe_prices);

        $made_products = MadeRecipeProduct::whereBetween('date', [date('Y-m-d', strtotime($starting_date)), date('Y-m-d', strtotime($ending_date))])->get();
        $made_product_prices = [];
        foreach($made_products as $product){
            $made_product_prices[] = $product->quantity * $product->price;
        }

        $product_inventory_total_price = array_sum($made_product_prices) - array_sum($customer_bought_product_total_prices);

        $inventory_accounts = $material_inventory_total_price + $product_inventory_total_price;

        $employee_monthly_salary = EmployeePaymentView::where('status', 1)->where('is_pay', 0)->whereBetween('month', [date('Y-m', strtotime($starting_date)), date('Y-m', strtotime($ending_date))])->get();
        $employee_daily_salary = EmployeePaymentView::where('status', 1)->where('is_pay', 0)->whereBetween('ds_date', [date('Y-m-d', strtotime($starting_date)), date('Y-m-d', strtotime($ending_date))])->get();
        $supplier_paid_total_price = SupplierPayment::whereBetween('paid_date', [date('Y-m-d', strtotime($starting_date)), date('Y-m-d', strtotime($ending_date))])->sum('payable_amount');
        $accounts_payable = $employee_monthly_salary->sum('total_salary') + $employee_daily_salary->sum('total_salary') + $supplier_paid_total_price;
        
        $recipe_product_list = RecipeProduct::where('status', 1)->get();
        $recipe_product_avg_cost = [];
        foreach($recipe_product_list as $product){
            $made_product = MadeRecipeProduct::where('status', 1)->where('recipe_product_id', $product->id)->get();
            // dd($made_product->count());
            $made_product_total = [];
            if($made_product->count() !=0 ){
                foreach($made_product as $p){
                    $made_product_total[] = $p->quantity * $p->price;
                }
                $recipe_product_avg_cost[$product->id] = array_sum($made_product_total)/$made_product->sum('quantity');
            }
        }

        $production_cost = [];
        foreach($sold_products as $product){
            $production_cost[] = $recipe_product_avg_cost[$product->recipe_product_id] * $product->quantity;
        }

        $sales_revenue = array_sum($customer_bought_product_total_prices) - array_sum($production_cost);

        $other_revenue = Income::where('income_status', 1)->whereBetween('income_date', [date('Y-m-d', strtotime($starting_date)), date('Y-m-d', strtotime($ending_date))])->sum('income_amount');

        $employee_monthly_paid_salary = EmployeePaymentView::where('status', 1)->where('is_pay', 1)->whereBetween('month', [date('Y-m', strtotime($starting_date)), date('Y-m', strtotime($ending_date))])->get();
        $employee_daily_paid_salary = EmployeePaymentView::where('status', 1)->where('is_pay', 1)->whereBetween('ds_date', [date('Y-m-d', strtotime($starting_date)), date('Y-m-d', strtotime($ending_date))])->get();
        $direct_expenses = $employee_monthly_paid_salary->sum('total_salary') + $employee_daily_paid_salary->sum('total_salary') + $supplier_paid_total_price;
        $indirect_expenses = Expense::where('expens_status', 1)->whereBetween('expens_date', [date('Y-m-d', strtotime($starting_date)), date('Y-m-d', strtotime($ending_date))])->sum('expens_amount');
        
        return view(
            'admin.finance-accounting.balance-sheet',
            compact(
                'starting_date',
                'ending_date',
                'cash_in_boxes',
                'cash_in_banks',
                'fixed_assets',
                'non_current_liabilities',
                'account_receivable',
                'inventory_accounts',
                'accounts_payable',
                'sales_revenue',
                'other_revenue',
                'direct_expenses',
                'indirect_expenses'
            ));
    }
}
