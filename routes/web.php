<?php

use App\Http\Controllers\CustomerBuyProductController;
use App\Http\Controllers\CustomerPaymentController;
use App\Http\Controllers\CustomerProfileController;
use App\Http\Controllers\EmployeeAttendanceController;
use App\Http\Controllers\EmployeePaymentViewController;
use App\Http\Controllers\EmployeeSalarySetupController;
use App\Http\Controllers\MadeProductStockController;
use App\Http\Controllers\MakeRecipeProductController;
use App\Http\Controllers\MaterialPurchaseResponseController;
use App\Http\Controllers\MaterialStockController;
use App\Http\Controllers\OfficialInformationController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\RecipeMakeController;
use App\Http\Controllers\SalarySetupController;
use App\Http\Controllers\SalaryTypeController;
use App\Http\Controllers\SupplierPaymentController;
use App\Http\Controllers\SupplierProfile;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AccessController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AccountDetailController;
use App\Http\Controllers\ManageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RecycleController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeePersonalController;
use App\Http\Controllers\EmployeeEducationController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\MaterialPurchaseController;
use App\Http\Controllers\MaterialRecipeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\ExpenseCategoryController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\IncomeCategoryController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\DamageController;
use App\Http\Controllers\IncomeExpenseSummaryController;
use App\Http\Controllers\EmployeeContactController;
use App\Http\Controllers\EmployeeDocumentController;
use App\Http\Controllers\EmployeeLeaveController;
use App\Http\Controllers\ImportedProductController;
use App\Http\Controllers\ImportedProductStockController;
use App\Http\Controllers\RecipeProductController;
use App\Http\Controllers\ShiftController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

//admin panel routes start
Route::get('dashboard', [AdminController::class, 'index'])->middleware('verified');

Route::middleware(['role:Super Admin|Admin'])->group(function(){
    Route::get('dashboard/employee/', [EmployeeController::class, 'index']);
    Route::get('dashboard/employee/add', [EmployeeController::class, 'add']);
    Route::get('dashboard/employee/edit/{slug}', [EmployeeController::class, 'edit']);
    Route::get('dashboard/employee/profile/{slug}', [EmployeeController::class, 'profile']);
    Route::post('dashboard/employee/submit', [EmployeeController::class, 'insert']);
    Route::post('dashboard/employee/update', [EmployeeController::class, 'update']);
});

Route::middleware(['role:Super Admin'])->group(function(){
    Route::post('dashboard/employee/softdelete', [EmployeeController::class, 'softdelete']);
    Route::post('dashboard/employee/restore', [EmployeeController::class, 'restore']);
    Route::post('dashboard/employee/delete', [EmployeeController::class, 'delete']);
});

Route::middleware(['role:Super Admin|Admin'])->group(function(){
    Route::get('dashboard/employee/{code}', [EmployeePersonalController::class, 'index']);
    Route::get('dashboard/employee/{code}/education', [EmployeeEducationController::class, 'index']);
    Route::get('dashboard/employee/{code}/education/edit/{slug}', [EmployeeEducationController::class, 'edit']);
    Route::get('dashboard/employee/{code}/education/view/{slug}', [EmployeeEducationController::class, 'view']);
    Route::post('dashboard/employee/education/submit', [EmployeeEducationController::class, 'insert']);
    Route::post('dashboard/employee/education/update', [EmployeeEducationController::class, 'update']);
});

Route::middleware(['role:Super Admin'])->group(function(){
    Route::post('dashboard/employee/education/soft-delete', [EmployeeEducationController::class, 'softDelete']);
    Route::post('dashboard/employee/education/restore', [EmployeeEducationController::class, 'restore']);
    Route::post('dashboard/employee/education/delete', [EmployeeEducationController::class, 'delete']);
});

Route::middleware(['role:Super Admin|Admin'])->group(function(){
    Route::get('dashboard/employee/{code}/leave', [EmployeeLeaveController::class, 'index']);
    Route::get('dashboard/employee/{code}/leave/edit/{slug}', [EmployeeLeaveController::class, 'edit']);
    Route::post('dashboard/employee/leave/submit', [EmployeeLeaveController::class, 'insert']);
    Route::post('dashboard/employee/leave/update', [EmployeeLeaveController::class, 'update']);
});

Route::middleware(['role:Super Admin'])->group(function(){
    Route::post('dashboard/employee/leave/soft-delete', [EmployeeLeaveController::class, 'softDelete']);
    Route::post('dashboard/employee/leave/restore', [EmployeeLeaveController::class, 'restore']);
    Route::post('dashboard/employee/leave/delete', [EmployeeLeaveController::class, 'delete']);
});

// Contact info route start
Route::middleware(['role:Super Admin|Admin'])->group(function(){
    Route::get('dashboard/employee/{code}/contact/info', [EmployeeContactController::class, 'index']);
    Route::get('dashboard/employee/{code}/contact/info/edit/{id}', [EmployeeContactController::class, 'edit']);
    Route::get('dashboard/employee/{code}/contact/info/view/{id}', [EmployeeContactController::class, 'view']);
    Route::post('dashboard/employee/contact/info/submit', [EmployeeContactController::class, 'insert']);
    Route::post('dashboard/employee/contact/info/update', [EmployeeContactController::class, 'update']);
});

Route::middleware(['role:Super Admin'])->group(function(){
    Route::post('dashboard/employee/contact/info/softdelete', [EmployeeContactController::class, 'softdelete']);
    Route::post('dashboard/employee/contact/info/restore', [EmployeeContactController::class, 'restore']);
    Route::post('dashboard/employee/contact/info/delete', [EmployeeContactController::class, 'delete']);
});

// Document route start
Route::middleware(['role:Super Admin|Admin'])->group(function(){
    Route::get('dashboard/employee/{code}/document', [EmployeeDocumentController::class, 'index']);
    Route::get('dashboard/employee/{code}/document/edit/{id}', [EmployeeDocumentController::class, 'edit']);
    Route::get('dashboard/employee/{code}/document/view/{id}', [EmployeeDocumentController::class, 'view']);
    Route::post('dashboard/employee/document/submit', [EmployeeDocumentController::class, 'insert']);
    Route::post('dashboard/employee/document/update', [EmployeeDocumentController::class, 'update']);
});

Route::middleware(['role:Super Admin'])->group(function(){
    Route::post('dashboard/employee/document/softdelete', [EmployeeDocumentController::class, 'softdelete']);
    Route::post('dashboard/employee/document/restore', [EmployeeDocumentController::class, 'restore']);
    Route::post('dashboard/employee/document/delete', [EmployeeDocumentController::class, 'delete']);
});

Route::middleware(['role:Super Admin'])->group(function(){
    Route::get('dashboard/manage/basic', [ManageController::class, 'basic']);
    Route::post('dashboard/manage/basic/update', [ManageController::class, 'update_basic']);
    Route::get('dashboard/manage/social', [ManageController::class, 'social_media']);
    Route::post('dashboard/manage/social/update', [ManageController::class, 'update_social_media']);
    Route::get('dashboard/manage/contact', [ManageController::class, 'infoCon']);
    Route::post('dashboard/manage/contact/update', [ManageController::class, 'update_contact']);
});

Route::middleware(['role:Super Admin|Admin|Data Entry'])->group(function(){
    Route::get('dashboard/account', [AccountController::class, 'index']);
    Route::get('dashboard/account/update-password/{slug}', [AccountController::class, 'editPassword']);
    Route::post('dashboard/account/update-password/{slug}', [AccountController::class, 'updatePassword']);
});

Route::middleware(['role:Super Admin'])->group(function(){
    Route::get('dashboard/user', [UserController::class, 'index']);
    Route::get('dashboard/user/add', [UserController::class, 'add']);
    Route::get('dashboard/user/edit/{slug}', [UserController::class, 'edit']);
    Route::get('dashboard/user/view/{slug}', [UserController::class, 'view']);
    Route::post('dashboard/user/submit', [UserController::class, 'insert']);
    Route::post('dashboard/user/update', [UserController::class, 'update']);
    Route::post('dashboard/user/softdelete', [UserController::class, 'softdelete']);
    Route::post('dashboard/user/restore', [UserController::class, 'restore']);
    Route::post('dashboard/user/delete', [UserController::class, 'delete']);
});

// shift route start
Route::middleware(['role:Super Admin|Admin'])->group(function(){
    Route::get('dashboard/shift', [ShiftController::class, 'index']);
    Route::get('dashboard/shift/add', [ShiftController::class, 'add']);
    Route::get('dashboard/shift/edit/{id}', [ShiftController::class, 'edit']);
    Route::get('dashboard/shift/info/{id}', [ShiftController::class, 'shiftInfo']);
    Route::post('dashboard/shift/submit', [ShiftController::class, 'insert']);
    Route::post('dashboard/shift/update', [ShiftController::class, 'update']);
});

Route::middleware(['role:Super Admin'])->group(function(){
    Route::post('dashboard/shift/softdelete', [ShiftController::class, 'softdelete']);
    Route::post('dashboard/shift/restore', [ShiftController::class, 'restore']);
    Route::post('dashboard/shift/delete', [ShiftController::class, 'delete']);
});

// customer route start
Route::middleware(['role:Super Admin|Admin'])->group(function(){
    Route::get('dashboard/customer', [CustomerController::class, 'index']);
    Route::get('dashboard/customer/add', [CustomerController::class, 'add']);
    Route::get('dashboard/customer/edit/{slug}', [CustomerController::class, 'edit']);
    Route::get('dashboard/customer/view/{slug}', [CustomerController::class, 'view']);
    Route::post('dashboard/customer/submit', [CustomerController::class, 'insert']);
    Route::post('dashboard/customer/update', [CustomerController::class, 'update']);
});

Route::middleware(['role:Super Admin'])->group(function(){
    Route::post('dashboard/customer/softdelete', [CustomerController::class, 'softdelete']);
    Route::post('dashboard/customer/restore', [CustomerController::class, 'restore']);
    Route::post('dashboard/customer/delete', [CustomerController::class, 'delete']);
});

Route::middleware(['role:Super Admin|Admin'])->group(function(){
    Route::get('dashboard/customer/profile/{profileSlug}', [CustomerProfileController::class, 'index']);
    Route::get('dashboard/customer/product-deliver', [CustomerBuyProductController::class, 'index']);
    Route::post('dashboard/customer/product-deliver', [CustomerBuyProductController::class, 'store']);
    Route::get('dashboard/customer/product-deliver/create/{slug}', [CustomerBuyProductController::class, 'create']);
    Route::post('dashboard/customer/get-make-product-item', [CustomerBuyProductController::class, 'makeProductItem']);

    //Customer-payment issues
    Route::get('dashboard/customer/payment', [CustomerPaymentController::class, 'index']);
    Route::get('dashboard/customer/payment/{slug}', [CustomerPaymentController::class, 'create']);
    Route::post('dashboard/customer/payment/{slug}', [CustomerPaymentController::class, 'store']);
});

// Supplier route start
Route::middleware(['role:Super Admin|Admin'])->group(function(){
    Route::get('dashboard/supplier/{slug}', [SupplierProfile::class, 'profile']);
    Route::get('dashboard/supplier', [SupplierController::class, 'index']);
    Route::get('dashboard/supplier/create/new', [SupplierController::class, 'add']);
    Route::get('dashboard/supplier/edit/{slug}', [SupplierController::class, 'edit']);
    Route::get('dashboard/supplier/view/{slug}', [SupplierController::class, 'view']);
    Route::post('dashboard/supplier/submit', [SupplierController::class, 'insert']);
    Route::post('dashboard/supplier/update', [SupplierController::class, 'update']);
    Route::get('dashboard/supplier/{slug}/print-report', [SupplierProfile::class, 'printReport']);
});

Route::middleware(['role:Super Admin'])->group(function(){
    Route::post('dashboard/supplier/softdelete', [SupplierController::class, 'softdelete']);
    Route::post('dashboard/supplier/restore', [SupplierController::class, 'restore']);
    Route::post('dashboard/supplier/delete', [SupplierController::class, 'delete']);
});

//material routes
Route::middleware(['role:Super Admin|Admin|Data Entry'])->group(function(){
    Route::get('dashboard/material', [MaterialController::class, 'index']);
    Route::get('dashboard/material/add', [MaterialController::class, 'add']);
    Route::get('dashboard/material/edit/{slug}', [MaterialController::class, 'edit']);
    Route::get('dashboard/material/view/{slug}', [MaterialController::class, 'view']);
    Route::post('dashboard/material/submit', [MaterialController::class, 'insert']);
    Route::post('dashboard/material/update', [MaterialController::class, 'update']);
    //imported products
    Route::get('dashboard/imported-product', [ImportedProductController::class, 'index']);
    Route::get('dashboard/imported-product/add', [ImportedProductController::class, 'add']);
    Route::get('dashboard/imported-product/edit/{slug}', [ImportedProductController::class, 'edit']);
    Route::get('dashboard/imported-product/view/{slug}', [ImportedProductController::class, 'view']);
    Route::post('dashboard/imported-product/submit', [ImportedProductController::class, 'insert']);
    Route::post('dashboard/imported-product/update', [ImportedProductController::class, 'update']);
    //imported products stock
    Route::get('dashboard/imported-product/stock', [ImportedProductStockController::class, 'index']);
    Route::get('dashboard/imported-product/stock-purchase/add', [ImportedProductStockController::class, 'create']);
    Route::post('dashboard/imported-product/stock-purchase/submit', [ImportedProductStockController::class, 'store']);
    Route::get('dashboard/imported-product/stock-purchases/{product}', [ImportedProductStockController::class, 'view']);
    Route::get('dashboard/imported-product/stock-purchases/edit/{product}', [ImportedProductStockController::class, 'edit']);
    Route::post('dashboard/imported-product/stock-purchase/update', [ImportedProductStockController::class, 'update']);
    //material purchase routes
    Route::get('dashboard/material/purchase', [MaterialPurchaseController::class, 'index']);
    Route::get('dashboard/material/purchase/add', [MaterialPurchaseController::class, 'add']);
    Route::get('dashboard/material/purchase/edit/{slug}', [MaterialPurchaseController::class, 'edit']);
    Route::get('dashboard/material/purchase/view/{slug}', [MaterialPurchaseController::class, 'view']);
    Route::post('dashboard/material/purchase/submit', [MaterialPurchaseController::class, 'insert']);
    Route::post('dashboard/material/purchase/update', [MaterialPurchaseController::class, 'update']);
    Route::post('dashboard/material/purchase/get-purchase-info', [MaterialPurchaseResponseController::class, 'getPurchaseInfo']);
    // material damage
    Route::get('dashboard/material/damage', [DamageController::class, 'index']);
    Route::get('dashboard/material/damage/add', [DamageController::class, 'add']);
    Route::get('dashboard/material/damage/ajax/{material_id}', [DamageController::class, 'getdamage']);
    Route::get('dashboard/material/damage/edit/{slug}', [DamageController::class, 'edit']);
    Route::get('dashboard/material/damage/view/{slug}', [DamageController::class, 'view']);
    Route::post('dashboard/material/damage/submit', [DamageController::class, 'insert']);
    Route::post('dashboard/material/damage/update', [DamageController::class, 'update']);

    Route::get('dashboard/material/stock',[ MaterialStockController::class,'index']);
    Route::get('dashboard/material/used',[ MaterialStockController::class,'used']);
    Route::get('dashboard/material/stock/list',[ MaterialStockController::class,'materialDamageWithStock']);
    Route::get('dashboard/material/{slug}/purchases-info',[ MaterialStockController::class,'materialPurchases']);
    Route::get('dashboard/material/chalan/stock/{slug}',[ MaterialStockController::class,'chanalStock']);
});

Route::middleware(['role:Super Admin'])->group(function(){
    Route::post('dashboard/material/softdelete', [MaterialController::class, 'softdelete']);
    Route::post('dashboard/material/restore', [MaterialController::class, 'restore']);
    Route::post('dashboard/material/delete', [MaterialController::class, 'delete']);
    //imported materials
    Route::post('dashboard/imported-product/softdelete', [ImportedProductController::class, 'softdelete']);
    Route::post('dashboard/imported-product/restore', [ImportedProductController::class, 'restore']);
    Route::post('dashboard/imported-product/delete', [ImportedProductController::class, 'delete']);
    //material purchase routes
    Route::post('dashboard/material/purchase/softdelete', [MaterialPurchaseController::class, 'softdelete']);
    Route::post('dashboard/material/purchase/restore', [MaterialPurchaseController::class, 'restore']);
    Route::post('dashboard/material/purchase/delete', [MaterialPurchaseController::class, 'delete']);
    // material damage
    Route::post('dashboard/material/damage/softdelete', [DamageController::class, 'softdelete']);
    Route::post('dashboard/material/damage/restore', [DamageController::class, 'restore']);
    Route::post('dashboard/material/damage/delete', [DamageController::class, 'delete']);
});


Route::middleware(['role:Super Admin'])->group(function(){
    Route::get('dashboard/recycle', [RecycleController::class, 'index']);
    Route::get('dashboard/recycle/user', [RecycleController::class, 'user']);
    Route::get('dashboard/recycle/income', [RecycleController::class, 'income']);
    Route::get('dashboard/recycle/income-category', [RecycleController::class, 'incomeCat']);
    Route::get('dashboard/recycle/expense', [RecycleController::class, 'expense']);
    Route::get('dashboard/recycle/expense-category', [RecycleController::class, 'expenseCat']);
    Route::get('dashboard/recycle/employee', [RecycleController::class, 'employee']);
    Route::get('dashboard/recycle/department', [RecycleController::class, 'department']);
    Route::get('dashboard/recycle/designation', [RecycleController::class, 'designation']);
    Route::get('dashboard/recycle/daily-shift', [RecycleController::class, 'dailyShift']);
    Route::get('dashboard/recycle/employee-attendance', [RecycleController::class, 'employeeAttendance']);
    Route::get('dashboard/recycle/employee-education', [RecycleController::class, 'employeeEducation']);
    Route::get('dashboard/recycle/employee-leave', [RecycleController::class, 'employeeLeave']);
    Route::get('dashboard/recycle/salary-type', [RecycleController::class, 'salaryType']);
    Route::get('dashboard/recycle/salary-setup', [RecycleController::class, 'salarySetup']);
    Route::get('dashboard/recycle/employee-payment', [RecycleController::class, 'employeePayment']);
    Route::get('dashboard/recycle/material', [RecycleController::class, 'material']);
    Route::get('dashboard/recycle/material-purchase', [RecycleController::class, 'materialPurchase']);
    Route::get('dashboard/recycle/material-damage', [RecycleController::class, 'materialDamage']);
    Route::get('dashboard/recycle/recipe', [RecycleController::class, 'recipe']);
    Route::get('dashboard/recycle/recipe-product', [RecycleController::class, 'recipeProduct']);
    Route::get('dashboard/recycle/made-recipe-product', [RecycleController::class, 'madeRecipeProduct']);
    Route::get('dashboard/recycle/customer', [RecycleController::class, 'customer']);
    Route::get('dashboard/recycle/supplier', [RecycleController::class, 'supplier']);
});

Route::middleware(['role:Super Admin|Admin'])->group(function(){
    Route::get('dashboard/designation', [DesignationController::class, 'index']);
    Route::get('dashboard/designation/add', [DesignationController::class, 'add']);
    Route::get('dashboard/designation/edit/{slug}', [DesignationController::class, 'edit']);
    Route::get('dashboard/designation/view/{slug}', [DesignationController::class, 'view']);
    Route::post('dashboard/designation/submit', [DesignationController::class, 'insert']);
    Route::post('dashboard/designation/update', [DesignationController::class, 'update']);
});

Route::middleware(['role:Super Admin'])->group(function(){
    Route::post('dashboard/designation/softdelete', [DesignationController::class, 'softdelete']);
    Route::post('dashboard/designation/restore', [DesignationController::class, 'restore']);
    Route::post('dashboard/designation/delete', [DesignationController::class, 'delete']);
});

Route::middleware(['role:Super Admin|Admin'])->group(function(){
    Route::get('dashboard/department', [DepartmentController::class, 'index']);
    Route::get('dashboard/department/add', [DepartmentController::class, 'add']);
    Route::get('dashboard/department/edit/{slug}', [DepartmentController::class, 'edit']);
    Route::get('dashboard/department/view/{slug}', [DepartmentController::class, 'view']);
    Route::post('dashboard/department/submit', [DepartmentController::class, 'insert']);
    Route::post('dashboard/department/update', [DepartmentController::class, 'update']);
});

Route::middleware(['role:Super Admin'])->group(function(){
    Route::post('dashboard/department/softdelete', [DepartmentController::class, 'softdelete']);
    Route::post('dashboard/department/restore', [DepartmentController::class, 'restore']);
    Route::post('dashboard/department/delete', [DepartmentController::class, 'delete']);
});

Route::middleware(['role:Super Admin|Admin'])->group(function(){
    Route::get('dashboard/expense/category', [ExpenseCategoryController::class, 'index']);
    Route::get('dashboard/expense/category/add', [ExpenseCategoryController::class, 'add']);
    Route::get('dashboard/expense/category/edit/{slug}', [ExpenseCategoryController::class, 'edit']);
    Route::get('dashboard/expense/category/view/{slug}', [ExpenseCategoryController::class, 'view']);
    Route::post('dashboard/expense/category/submit', [ExpenseCategoryController::class, 'insert']);
    Route::post('dashboard/expense/category/update', [ExpenseCategoryController::class, 'update']);
});

Route::middleware(['role:Super Admin'])->group(function(){
    Route::post('dashboard/expense/category/softdelete', [ExpenseCategoryController::class, 'softdelete']);
    Route::post('dashboard/expense/category/restore', [ExpenseCategoryController::class, 'restore']);
    Route::post('dashboard/expense/category/delete', [ExpenseCategoryController::class, 'delete']);
});

Route::middleware(['role:Super Admin|Admin|Data Entry'])->group(function(){
    Route::get('dashboard/expense', [ExpenseController::class, 'index']);
    Route::get('dashboard/expense/add', [ExpenseController::class, 'add']);
    Route::get('dashboard/expense/edit/{slug}', [ExpenseController::class, 'edit']);
    Route::get('dashboard/expense/view/{slug}', [ExpenseController::class, 'view']);
    Route::post('dashboard/expense/submit', [ExpenseController::class, 'insert']);
    Route::post('dashboard/expense/update', [ExpenseController::class, 'update']);
});

Route::middleware(['role:Super Admin'])->group(function(){
    Route::post('dashboard/expense/softdelete', [ExpenseController::class, 'softdelete']);
    Route::post('dashboard/expense/restore', [ExpenseController::class, 'restore']);
    Route::post('dashboard/expense/delete', [ExpenseController::class, 'delete']);
});

Route::middleware(['role:Super Admin|Admin'])->group(function(){
    Route::get('dashboard/income/category', [IncomeCategoryController::class, 'index']);
    Route::get('dashboard/income/category/add', [IncomeCategoryController::class, 'add']);
    Route::get('dashboard/income/category/edit/{slug}', [IncomeCategoryController::class, 'edit']);
    Route::get('dashboard/income/category/view/{slug}', [IncomeCategoryController::class, 'view']);
    Route::post('dashboard/income/category/submit', [IncomeCategoryController::class, 'insert']);
    Route::post('dashboard/income/category/update', [IncomeCategoryController::class, 'update']);
});

Route::middleware(['role:Super Admin'])->group(function(){
    Route::post('dashboard/income/category/softdelete', [IncomeCategoryController::class, 'softdelete']);
    Route::post('dashboard/income/category/restore', [IncomeCategoryController::class, 'restore']);
    Route::post('dashboard/income/category/delete', [IncomeCategoryController::class, 'delete']);
});

Route::middleware(['role:Super Admin|Admin|Data Entry'])->group(function(){
    Route::get('dashboard/income', [IncomeController::class, 'index']);
    Route::get('dashboard/income/add', [IncomeController::class, 'add']);
    Route::get('dashboard/income/edit/{slug}', [IncomeController::class, 'edit']);
    Route::get('dashboard/income/view/{slug}', [IncomeController::class, 'view']);
    Route::post('dashboard/income/submit', [IncomeController::class, 'insert']);
    Route::post('dashboard/income/update', [IncomeController::class, 'update']);
});

Route::middleware(['role:Super Admin'])->group(function(){
    Route::post('dashboard/income/softdelete', [IncomeController::class, 'softdelete']);
    Route::post('dashboard/income/restore', [IncomeController::class, 'restore']);
    Route::post('dashboard/income/delete', [IncomeController::class, 'delete']);
});

Route::middleware(['role:Super Admin|Admin|Data Entry'])->group(function(){
    Route::get('dashboard/summary', [IncomeExpenseSummaryController::class, 'index']);
    Route::get('dashboard/summary/search/{from}/{to}', [IncomeExpenseSummaryController::class, 'search']);
});

Route::middleware(['role:Super Admin|Admin|Data Entry'])->group(function(){
    Route::get('dashboard/recipe', [RecipeController::class, 'index']);
    Route::get('dashboard/recipe/create', [RecipeController::class, 'create']);
    Route::post('dashboard/recipe', [RecipeController::class, 'store']);
    Route::get('dashboard/recipe/{slug}/edit', [RecipeController::class, 'edit']);
    Route::post('dashboard/recipe/update/{recipe}', [RecipeController::class, 'update']);
});

Route::middleware(['role:Super Admin'])->group(function(){
    Route::post('dashboard/recipe/delete/softdelete', [RecipeController::class, 'softdelete']);
    Route::post('dashboard/recipe/restore', [RecipeController::class, 'restore']);
    Route::post('dashboard/recipe/delete', [RecipeController::class, 'delete']);
});

Route::middleware(['role:Super Admin|Admin|Data Entry'])->group(function(){
    Route::get('dashboard/recipe-make', [RecipeMakeController::class, 'create']);
    Route::post('dashboard/recipe-material', [RecipeMakeController::class, 'materialRecipe']);
    Route::post('dashboard/recipe-material-store', [RecipeMakeController::class, 'recipeStore']);
    Route::get('dashboard/recipe-make-list/', [RecipeMakeController::class, 'makeList']);
    Route::get('dashboard/recipe-make-list/{recepie_id}/{date}', [RecipeMakeController::class, 'makeListView']);
    Route::get('dashboard/recipe-make-list/{id}', [RecipeMakeController::class, 'index']);
    Route::get('dashboard/recipe-product', [MakeRecipeProductController::class, 'index']);
    Route::get('dashboard/recipe-product/create', [MakeRecipeProductController::class, 'create']);
    Route::post('dashboard/recipe-product/store', [MakeRecipeProductController::class, 'store']);
    Route::post('dashboard/recipe-product/update/{slug}', [MakeRecipeProductController::class, 'update']);
    Route::get('dashboard/recipe-product/get-dates/{recipe_id}', [MakeRecipeProductController::class, 'getdates']);
    Route::get('dashboard/recipe-product/get-product/{slug}', [MakeRecipeProductController::class, 'getProduct']);
    Route::get('dashboard/recipe-product/list', [RecipeProductController::class, 'index']);
    Route::post('dashboard/recipe-product/list/submit', [RecipeProductController::class, 'store']);
    Route::post('dashboard/recipe-product/list/update/{slug}', [RecipeProductController::class, 'update']);
    Route::get('dashboard/recipe-product/list/get-item/{slug}', [RecipeProductController::class, 'getItem']);
    //Made product Recipe stock
    Route::get('dashboard/make-product/Stock', [MadeProductStockController::class,'index']);
});

Route::middleware(['role:Super Admin'])->group(function(){
    Route::post('dashboard/recipe-make-list/delete', [RecipeMakeController::class, 'delete']);
    Route::post('dashboard/recipe-product/softdelete', [MakeRecipeProductController::class, 'sofDelete']);
    Route::post('dashboard/recipe-product/restore', [MakeRecipeProductController::class, 'restore']);
    Route::post('dashboard/recipe-product/delete', [MakeRecipeProductController::class, 'delete']);
    Route::post('dashboard/recipe-product/list/softDelete', [RecipeProductController::class, 'softDelete']);
    Route::post('dashboard/recipe-product/list/restore', [RecipeProductController::class, 'restore']);
    Route::post('dashboard/recipe-product/list/delete', [RecipeProductController::class, 'delete']);
});

Route::middleware(['role:Super Admin|Admin'])->group(function(){
    Route::get('dashboard/attendance', [EmployeeAttendanceController::class, 'index']);
    Route::get('dashboard/attendance/create', [EmployeeAttendanceController::class, 'create']);
    Route::post('dashboard/attendance/store', [EmployeeAttendanceController::class, 'store']);
    Route::get('dashboard/attendance/{employeeAttendance}/edit', [EmployeeAttendanceController::class, 'edit']);
    Route::post('dashboard/attendance/{employeeAttendance}/update', [EmployeeAttendanceController::class, 'update']);
    Route::get('dashboard/employee/{employee}/attendance', [EmployeeAttendanceController::class, 'singleEmployeeAttendance']);
    Route::get('dashboard/attendance/out-time', [EmployeeAttendanceController::class, 'outTimeEmployeeAll']);
    Route::post('dashboard/attendance/out-time/update-by-day', [EmployeeAttendanceController::class, 'outTimeEmployeeAllUpdate']);
    Route::post('dashboard/attendance/outtime/updt', [EmployeeAttendanceController::class, 'outTimeEmployeeAllUpdate']);
});

Route::middleware(['role:Super Admin'])->group(function(){
    Route::post('dashboard/attendance/soft-delete', [EmployeeAttendanceController::class, 'softDelete']);
    Route::post('dashboard/attendance/restore', [EmployeeAttendanceController::class, 'restore']);
    Route::post('dashboard/attendance/permanent-delete', [EmployeeAttendanceController::class, 'delete']);
});

Route::middleware(['role:Super Admin|Admin'])->group(function(){
    //supplier-payment issues
    Route::get('dashboard/material/supplier-payment', [SupplierPaymentController::class,'index']);
    Route::get('dashboard/material/supplier-payment/add/{slug}', [SupplierPaymentController::class,'create']);
    Route::post('dashboard/material/supplier-payment/add/{slug}', [SupplierPaymentController::class,'store']);
    Route::post('dashboard/material/get-supply-info', [SupplierPaymentController::class,'getSupplyInfo']);

    Route::get('dashboard/employee/{code}/payment', [EmployeeController::class, 'payments']);

    Route::get('dashboard/{code}/official-info', [OfficialInformationController::class, 'index']);
    Route::post('dashboard/official-info/update', [OfficialInformationController::class, 'update']);
});


Route::middleware(['role:Super Admin|Admin'])->group(function(){
    Route::get('dashboard/payroll/salary_type', [SalaryTypeController::class, 'index']);
    Route::get('dashboard/payroll/salary_type/create', [SalaryTypeController::class, 'create']);
    Route::post('dashboard/payroll/salary_type', [SalaryTypeController::class, 'store']);
    Route::get('dashboard/payroll/salary_type/{salary_type}/edit', [SalaryTypeController::class, 'edit']);
    Route::post('dashboard/payroll/salary_type/{salary_type}', [SalaryTypeController::class, 'update']);

    Route::get('dashboard/payroll/salary_setup', [SalarySetupController::class, 'index']);
    Route::get('dashboard/payroll/salary_setup/create', [SalarySetupController::class, 'create']);
    Route::post('dashboard/payroll/salary_setup/', [SalarySetupController::class, 'store']);
    Route::get('dashboard/payroll/salary_setup/{salary_setup}/edit', [SalarySetupController::class, 'edit']);
    Route::post('dashboard/payroll/salary_setup/{salary_setup}', [SalarySetupController::class, 'update']);
    Route::post('dashboard/payroll/employee/getSalaryType',[EmployeeSalarySetupController::class,'getSalaryType']);
});

Route::middleware(['role:Super Admin'])->group(function(){
    Route::post('dashboard/payroll/salary_type/delete/soft-delete', [SalaryTypeController::class, 'softDelete']);
    Route::post('dashboard/payroll/salary_type/delete/restore', [SalaryTypeController::class, 'restore']);
    Route::post('dashboard/payroll/salary_type/delete/delete', [SalaryTypeController::class, 'delete']);

    Route::post('dashboard/payroll/salary_setup/delete/soft-delete', [SalarySetupController::class, 'softDelete']);
    Route::post('dashboard/payroll/salary_setup/delete/restore', [SalarySetupController::class, 'restore']);
    Route::post('dashboard/payroll/salary_setup/delete/delete', [SalarySetupController::class, 'delete']);
});

Route::middleware(['role:Super Admin|Admin'])->group(function(){
    Route::get('dashboard/payroll/employee_payment_view',[EmployeePaymentViewController::class,'index']);
    Route::get('dashboard/payroll/employee_payment_view/add',[EmployeePaymentViewController::class,'create']);
    Route::post('dashboard/payroll/employee_payment_view',[EmployeePaymentViewController::class,'store']);
    Route::post('dashboard/payroll/get_employee_payment',[EmployeePaymentViewController::class,'getSalarySetup']);
    Route::post('dashboard/payroll/pay_employee_payment',[EmployeePaymentViewController::class,'paySalarySetup']);
    Route::post('dashboard/payroll/paid_employee_payment',[EmployeePaymentViewController::class,'updatePayment']);
    Route::get('dashboard/payroll/employee_payment_view/{employeePaymentView}/edit',[EmployeePaymentViewController::class,'edit']);
    Route::post('dashboard/payroll/employee_payment_view/{employeePaymentView}',[EmployeePaymentViewController::class,'update']);
    Route::get('dashboard/payroll/employee_payment_view/{employeePaymentView}/payslip',[EmployeePaymentViewController::class,'payslip']);
});

Route::middleware(['role:Super Admin'])->group(function(){
    Route::post('dashboard/payroll/employee_payment_view/delete/soft-delete',[EmployeePaymentViewController::class,'softDelete']);
    Route::post('dashboard/payroll/employee_payment_view/delete/restore',[EmployeePaymentViewController::class,'restore']);
    Route::post('dashboard/payroll/employee_payment_view/delete/delete',[EmployeePaymentViewController::class,'delete']);
});

Route::middleware(['role:Super Admin|Admin'])->group(function(){
    Route::post('dashboard/employee/payment/overtime', [EmployeePaymentViewController::class, 'getOverTime']);
    Route::get('/dashboard/accounts-info', [AccountDetailController::class, 'index']);
    Route::post('/dashboard/accounts-info/submit', [AccountDetailController::class, 'store']);
    Route::post('/dashboard/accounts-info/update/{slug}', [AccountDetailController::class, 'update']);
    Route::get('/dashboard/accounts-info/edit/{slug}', [AccountDetailController::class, 'edit']);
    Route::get('/dashboard/balance-sheet', [AccountDetailController::class, 'balanceSheet']);
});

require __DIR__.'/auth.php';


// Route::middleware(['role:Super Admin|Admin|Data Entry'])->group(function(){

// });


// Route::resource('create_salary_generate',SalaryGenerateController::class);

// Route::get('dashboard/account/invoice', [AccountController::class, 'invoice']);
// Route::get('/dashboard/balance-sheet', function(){
//     return view('admin.finance-accounting.balance-sheet');
// });

// Route::get('/dashboard/cash-flow', function(){
//     return view('admin.finance-accounting.cash-flow');
// });
// Route::get('dashboard/material/recipe', [MaterialRecipeController::class, 'index']);
// Route::get('dashboard/material/recipe/add', [MaterialRecipeController::class, 'add']);
// Route::get('dashboard/material/recipe/edit/{slug}', [MaterialRecipeController::class, 'edit']);
// Route::get('dashboard/material/recipe/view/{slug}', [MaterialRecipeController::class, 'view']);
// Route::post('dashboard/material/recipe/submit', [MaterialRecipeController::class, 'insert']);
// Route::post('dashboard/material/recipe/update', [MaterialRecipeController::class, 'update']);
// Route::post('dashboard/material/recipe/softdelete', [MaterialRecipeController::class, 'softdelete']);
// Route::post('dashboard/material/recipe/restore', [MaterialRecipeController::class, 'restore']);
// Route::post('dashboard/material/recipe/delete', [MaterialRecipeController::class, 'delete']);

// Route::get('/report', [ReportController::class, 'index']);
// Route::get('dashboard/access', [AccessController::class, 'index']);