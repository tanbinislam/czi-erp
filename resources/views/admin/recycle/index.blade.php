@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="card mini-stats-wid">
            <div class="card-body">
                <div class="media">
                    @php
                      $totalUser=App\Models\User::where('status',0)->count();
                    @endphp
                    <div class="media-body">
                        <p class="text-muted font-weight-medium font-size-18">Users</p>
                        <h4 class="mb-0">
                          @if($totalUser < 10)
                            0{{$totalUser}}
                          @else
                            {{$totalUser}}
                          @endif
                        </h4>
                    </div>
                    <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                        <span class="avatar-title bg-dark">
                            <i class="bx bx-trash font-size-24"></i>
                        </span>
                    </div>
                </div>
            </div>
            <a href="{{url('dashboard/recycle/user')}}" class="btn btn-md btn-dark btn-block btn_block btn_uppercase">View More</a>
        </div>
    </div>

    <div class="col-md-3">
      <div class="card mini-stats-wid">
          <div class="card-body">
              <div class="media">
                  @php
                    $totalIncome=App\Models\Income::where('income_status',0)->count();
                  @endphp
                  <div class="media-body">
                      <p class="text-muted font-weight-medium font-size-18">Income</p>
                      <h4 class="mb-0">
                        @if($totalIncome < 10)
                          0{{$totalIncome}}
                        @else
                          {{$totalIncome}}
                        @endif
                      </h4>
                  </div>
                  <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                      <span class="avatar-title bg-dark">
                          <i class="bx bx-trash font-size-24"></i>
                      </span>
                  </div>
              </div>
          </div>
          <a href="{{url('dashboard/recycle/income')}}" class="btn btn-md btn-dark btn-block btn_block btn_uppercase">View More</a>
      </div>
  </div>

  <div class="col-md-3">
    <div class="card mini-stats-wid">
        <div class="card-body">
            <div class="media">
                @php
                  $totalinccat=App\Models\IncomeCategory::where('in_cat_status',0)->count();
                @endphp
                <div class="media-body">
                    <p class="text-muted font-weight-medium font-size-18">Income Category</p>
                    <h4 class="mb-0">
                      @if($totalinccat < 10)
                        0{{$totalinccat}}
                      @else
                        {{$totalinccat}}
                      @endif
                    </h4>
                </div>
                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                    <span class="avatar-title bg-dark">
                        <i class="bx bx-trash font-size-24"></i>
                    </span>
                </div>
            </div>
        </div>
        <a href="{{url('dashboard/recycle/income-category')}}" class="btn btn-md btn-dark btn-block btn_block btn_uppercase">View More</a>
    </div>
  </div>

  <div class="col-md-3">
    <div class="card mini-stats-wid">
        <div class="card-body">
            <div class="media">
                @php
                  $totalexp=App\Models\Expense::where('expens_status',0)->count();
                @endphp
                <div class="media-body">
                    <p class="text-muted font-weight-medium font-size-18">Expense</p>
                    <h4 class="mb-0">
                      @if($totalexp < 10)
                        0{{$totalexp}}
                      @else
                        {{$totalexp}}
                      @endif
                    </h4>
                </div>
                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                    <span class="avatar-title bg-dark">
                        <i class="bx bx-trash font-size-24"></i>
                    </span>
                </div>
            </div>
        </div>
        <a href="{{url('dashboard/recycle/expense')}}" class="btn btn-md btn-dark btn-block btn_block btn_uppercase">View More</a>
    </div>
  </div>

  <div class="col-md-3">
    <div class="card mini-stats-wid">
        <div class="card-body">
            <div class="media">
                @php
                  $totalexpcat=App\Models\ExpenseCategory::where('exp_cat_status',0)->count();
                @endphp
                <div class="media-body">
                    <p class="text-muted font-weight-medium font-size-18">Expense Category</p>
                    <h4 class="mb-0">
                      @if($totalexpcat < 10)
                        0{{$totalexpcat}}
                      @else
                        {{$totalexpcat}}
                      @endif
                    </h4>
                </div>
                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                    <span class="avatar-title bg-dark">
                        <i class="bx bx-trash font-size-24"></i>
                    </span>
                </div>
            </div>
        </div>
        <a href="{{url('dashboard/recycle/expense-category')}}" class="btn btn-md btn-dark btn-block btn_block btn_uppercase">View More</a>
    </div>
  </div>

  <div class="col-md-3">
    <div class="card mini-stats-wid">
        <div class="card-body">
            <div class="media">
                @php
                  $to_emp=App\Models\Employee::where('employee_status',0)->count();
                @endphp
                <div class="media-body">
                    <p class="text-muted font-weight-medium font-size-18">Employee</p>
                    <h4 class="mb-0">
                      @if($to_emp < 10)
                        0{{$to_emp}}
                      @else
                        {{$to_emp}}
                      @endif
                    </h4>
                </div>
                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                    <span class="avatar-title bg-dark">
                        <i class="bx bx-trash font-size-24"></i>
                    </span>
                </div>
            </div>
        </div>
        <a href="{{url('dashboard/recycle/employee')}}" class="btn btn-md btn-dark btn-block btn_block btn_uppercase">View More</a>
    </div>
  </div>

  <div class="col-md-3">
    <div class="card mini-stats-wid">
        <div class="card-body">
            <div class="media">
                @php
                  $total_department=App\Models\Department::where('department_status',0)->count();
                @endphp
                <div class="media-body">
                    <p class="text-muted font-weight-medium font-size-18">Department</p>
                    <h4 class="mb-0">
                      @if($total_department < 10)
                        0{{$total_department}}
                      @else
                        {{$total_department}}
                      @endif
                    </h4>
                </div>
                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                    <span class="avatar-title bg-dark">
                        <i class="bx bx-trash font-size-24"></i>
                    </span>
                </div>
            </div>
        </div>
        <a href="{{url('dashboard/recycle/department')}}" class="btn btn-md btn-dark btn-block btn_block btn_uppercase">View More</a>
    </div>
  </div>

  <div class="col-md-3">
    <div class="card mini-stats-wid">
        <div class="card-body">
            <div class="media">
                @php
                  $t_desig=App\Models\Designation::where('designation_status',0)->count();
                @endphp
                <div class="media-body">
                    <p class="text-muted font-weight-medium font-size-18">Designation</p>
                    <h4 class="mb-0">
                      @if($t_desig < 10)
                        0{{$t_desig}}
                      @else
                        {{$t_desig}}
                      @endif
                    </h4>
                </div>
                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                    <span class="avatar-title bg-dark">
                        <i class="bx bx-trash font-size-24"></i>
                    </span>
                </div>
            </div>
        </div>
        <a href="{{url('dashboard/recycle/designation')}}" class="btn btn-md btn-dark btn-block btn_block btn_uppercase">View More</a>
    </div>
  </div>

  <div class="col-md-3">
    <div class="card mini-stats-wid">
        <div class="card-body">
            <div class="media">
                @php
                  $t_shift=App\Models\DailyShift::where('status',0)->count();
                @endphp
                <div class="media-body">
                    <p class="text-muted font-weight-medium font-size-18">Daily Shift</p>
                    <h4 class="mb-0">
                      @if($t_shift < 10)
                        0{{$t_shift}}
                      @else
                        {{$t_shift}}
                      @endif
                    </h4>
                </div>
                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                    <span class="avatar-title bg-dark">
                        <i class="bx bx-trash font-size-24"></i>
                    </span>
                </div>
            </div>
        </div>
        <a href="{{url('dashboard/recycle/daily-shift')}}" class="btn btn-md btn-dark btn-block btn_block btn_uppercase">View More</a>
    </div>
  </div>

  <div class="col-md-3">
    <div class="card mini-stats-wid">
        <div class="card-body">
            <div class="media">
                @php
                  $t_emp_att=App\Models\EmployeeAttendance::where('status',0)->count();
                @endphp
                <div class="media-body">
                    <p class="text-muted font-weight-medium font-size-18">Employee Attendance</p>
                    <h4 class="mb-0">
                      @if($t_emp_att < 10)
                        0{{$t_emp_att}}
                      @else
                        {{$t_emp_att}}
                      @endif
                    </h4>
                </div>
                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                    <span class="avatar-title bg-dark">
                        <i class="bx bx-trash font-size-24"></i>
                    </span>
                </div>
            </div>
        </div>
        <a href="{{url('dashboard/recycle/employee-attendance')}}" class="btn btn-md btn-dark btn-block btn_block btn_uppercase">View More</a>
    </div>
  </div>

  <div class="col-md-3">
    <div class="card mini-stats-wid">
        <div class="card-body">
            <div class="media">
                @php
                  $t_empedu=App\Models\EmployeeEducation::where('empedu_status',0)->count();
                @endphp
                <div class="media-body">
                    <p class="text-muted font-weight-medium font-size-18">Employee Education</p>
                    <h4 class="mb-0">
                      @if($totalexpcat < 10)
                        0{{$totalexpcat}}
                      @else
                        {{$totalexpcat}}
                      @endif
                    </h4>
                </div>
                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                    <span class="avatar-title bg-dark">
                        <i class="bx bx-trash font-size-24"></i>
                    </span>
                </div>
            </div>
        </div>
        <a href="{{url('dashboard/recycle/employee-education')}}" class="btn btn-md btn-dark btn-block btn_block btn_uppercase">View More</a>
    </div>
  </div>

  <div class="col-md-3">
    <div class="card mini-stats-wid">
        <div class="card-body">
            <div class="media">
                @php
                  $t_emp_leave=App\Models\EmployeeLeave::where('status',0)->count();
                @endphp
                <div class="media-body">
                    <p class="text-muted font-weight-medium font-size-18">Employee Leave</p>
                    <h4 class="mb-0">
                      @if($t_emp_leave < 10)
                        0{{$t_emp_leave}}
                      @else
                        {{$t_emp_leave}}
                      @endif
                    </h4>
                </div>
                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                    <span class="avatar-title bg-dark">
                        <i class="bx bx-trash font-size-24"></i>
                    </span>
                </div>
            </div>
        </div>
        <a href="{{url('dashboard/recycle/employee-leave')}}" class="btn btn-md btn-dark btn-block btn_block btn_uppercase">View More</a>
    </div>
  </div>

  <div class="col-md-3">
    <div class="card mini-stats-wid">
        <div class="card-body">
            <div class="media">
                @php
                  $t_salary_type=App\Models\SalaryType::where('status',0)->count();
                @endphp
                <div class="media-body">
                    <p class="text-muted font-weight-medium font-size-18">Salary Type</p>
                    <h4 class="mb-0">
                      @if($t_salary_type < 10)
                        0{{$t_salary_type}}
                      @else
                        {{$t_salary_type}}
                      @endif
                    </h4>
                </div>
                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                    <span class="avatar-title bg-dark">
                        <i class="bx bx-trash font-size-24"></i>
                    </span>
                </div>
            </div>
        </div>
        <a href="{{url('dashboard/recycle/salary-type')}}" class="btn btn-md btn-dark btn-block btn_block btn_uppercase">View More</a>
    </div>
  </div>

  <div class="col-md-3">
    <div class="card mini-stats-wid">
        <div class="card-body">
            <div class="media">
                @php
                  $t_salary_setup=App\Models\SalarySetup::where('status',0)->count();
                @endphp
                <div class="media-body">
                    <p class="text-muted font-weight-medium font-size-18">Salary Setup</p>
                    <h4 class="mb-0">
                      @if($t_salary_setup < 10)
                        0{{$t_salary_setup}}
                      @else
                        {{$t_salary_setup}}
                      @endif
                    </h4>
                </div>
                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                    <span class="avatar-title bg-dark">
                        <i class="bx bx-trash font-size-24"></i>
                    </span>
                </div>
            </div>
        </div>
        <a href="{{url('dashboard/recycle/salary-setup')}}" class="btn btn-md btn-dark btn-block btn_block btn_uppercase">View More</a>
    </div>
  </div>

  <div class="col-md-3">
    <div class="card mini-stats-wid">
        <div class="card-body">
            <div class="media">
                @php
                  $t_emp_pay_view=App\Models\EmployeePaymentView::where('status',0)->count();
                @endphp
                <div class="media-body">
                    <p class="text-muted font-weight-medium font-size-18"> Employee Payment</p>
                    <h4 class="mb-0">
                      @if($t_emp_pay_view < 10)
                        0{{$t_emp_pay_view}}
                      @else
                        {{$t_emp_pay_view}}
                      @endif
                    </h4>
                </div>
                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                    <span class="avatar-title bg-dark">
                        <i class="bx bx-trash font-size-24"></i>
                    </span>
                </div>
            </div>
        </div>
        <a href="{{url('dashboard/recycle/employee-payment')}}" class="btn btn-md btn-dark btn-block btn_block btn_uppercase">View More</a>
    </div>
  </div>

  <div class="col-md-3">
    <div class="card mini-stats-wid">
        <div class="card-body">
            <div class="media">
                @php
                  $t_material=App\Models\Material::where('material_status',0)->count();
                @endphp
                <div class="media-body">
                    <p class="text-muted font-weight-medium font-size-18">Material</p>
                    <h4 class="mb-0">
                      @if($t_material < 10)
                        0{{$t_material}}
                      @else
                        {{$t_material}}
                      @endif
                    </h4>
                </div>
                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                    <span class="avatar-title bg-dark">
                        <i class="bx bx-trash font-size-24"></i>
                    </span>
                </div>
            </div>
        </div>
        <a href="{{url('dashboard/recycle/material')}}" class="btn btn-md btn-dark btn-block btn_block btn_uppercase">View More</a>
    </div>
  </div>

  {{-- <div class="col-md-3">
    <div class="card mini-stats-wid">
        <div class="card-body">
            <div class="media">
                @php
                  $t_material_pur=App\Models\MaterialPurchase::where('mp_status',0)->count();
                @endphp
                <div class="media-body">
                    <p class="text-muted font-weight-medium font-size-18">Material Purchase</p>
                    <h4 class="mb-0">
                      @if($t_material_pur < 10)
                        0{{$t_material_pur}}
                      @else
                        {{$t_material_pur}}
                      @endif
                    </h4>
                </div>
                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                    <span class="avatar-title bg-dark">
                        <i class="bx bx-trash font-size-24"></i>
                    </span>
                </div>
            </div>
        </div>
        <a href="{{url('dashboard/recycle/material-purchase')}}" class="btn btn-md btn-dark btn-block btn_block btn_uppercase">View More</a>
    </div>
  </div> --}}

  <div class="col-md-3">
    <div class="card mini-stats-wid">
        <div class="card-body">
            <div class="media">
                @php
                  $t_material_damage=App\Models\Damage::where('damage_status',0)->count();
                @endphp
                <div class="media-body">
                    <p class="text-muted font-weight-medium font-size-18">Material Damage</p>
                    <h4 class="mb-0">
                      @if($t_material_damage < 10)
                        0{{$t_material_damage}}
                      @else
                        {{$t_material_damage}}
                      @endif
                    </h4>
                </div>
                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                    <span class="avatar-title bg-dark">
                        <i class="bx bx-trash font-size-24"></i>
                    </span>
                </div>
            </div>
        </div>
        <a href="{{url('dashboard/recycle/material-damage')}}" class="btn btn-md btn-dark btn-block btn_block btn_uppercase">View More</a>
    </div>
  </div>

  <div class="col-md-3">
    <div class="card mini-stats-wid">
        <div class="card-body">
            <div class="media">
                @php
                  $t_recipe=App\Models\Recipe::where('active',0)->count();
                @endphp
                <div class="media-body">
                    <p class="text-muted font-weight-medium font-size-18">Recipe</p>
                    <h4 class="mb-0">
                      @if($t_recipe < 10)
                        0{{$t_recipe}}
                      @else
                        {{$t_recipe}}
                      @endif
                    </h4>
                </div>
                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                    <span class="avatar-title bg-dark">
                        <i class="bx bx-trash font-size-24"></i>
                    </span>
                </div>
            </div>
        </div>
        <a href="{{url('dashboard/recycle/recipe')}}" class="btn btn-md btn-dark btn-block btn_block btn_uppercase">View More</a>
    </div>
  </div>

  <div class="col-md-3">
    <div class="card mini-stats-wid">
        <div class="card-body">
            <div class="media">
                @php
                  $t_recipe_product=App\Models\RecipeProduct::where('status',0)->count();
                @endphp
                <div class="media-body">
                    <p class="text-muted font-weight-medium font-size-18">Recipe Product</p>
                    <h4 class="mb-0">
                      @if($t_recipe_product < 10)
                        0{{$t_recipe_product}}
                      @else
                        {{$t_recipe_product}}
                      @endif
                    </h4>
                </div>
                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                    <span class="avatar-title bg-dark">
                        <i class="bx bx-trash font-size-24"></i>
                    </span>
                </div>
            </div>
        </div>
        <a href="{{url('dashboard/recycle/recipe-product')}}" class="btn btn-md btn-dark btn-block btn_block btn_uppercase">View More</a>
    </div>
  </div>

  <div class="col-md-3">
    <div class="card mini-stats-wid">
        <div class="card-body">
            <div class="media">
                @php
                  $t_made_recipe_product=App\Models\MadeRecipeProduct::where('status',0)->count();
                @endphp
                <div class="media-body">
                    <p class="text-muted font-weight-medium font-size-18">Made Recipe Product</p>
                    <h4 class="mb-0">
                      @if($t_made_recipe_product < 10)
                        0{{$t_made_recipe_product}}
                      @else
                        {{$t_made_recipe_product}}
                      @endif
                    </h4>
                </div>
                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                    <span class="avatar-title bg-dark">
                        <i class="bx bx-trash font-size-24"></i>
                    </span>
                </div>
            </div>
        </div>
        <a href="{{url('dashboard/recycle/made-recipe-product')}}" class="btn btn-md btn-dark btn-block btn_block btn_uppercase">View More</a>
    </div>
  </div>

  <div class="col-md-3">
    <div class="card mini-stats-wid">
        <div class="card-body">
            <div class="media">
                @php
                  $t_customer=App\Models\Customer::where('customer_status',0)->count();
                @endphp
                <div class="media-body">
                    <p class="text-muted font-weight-medium font-size-18">Customer</p>
                    <h4 class="mb-0">
                      @if($t_customer < 10)
                        0{{$t_customer}}
                      @else
                        {{$t_customer}}
                      @endif
                    </h4>
                </div>
                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                    <span class="avatar-title bg-dark">
                        <i class="bx bx-trash font-size-24"></i>
                    </span>
                </div>
            </div>
        </div>
        <a href="{{url('dashboard/recycle/customer')}}" class="btn btn-md btn-dark btn-block btn_block btn_uppercase">View More</a>
    </div>
  </div>

  <div class="col-md-3">
    <div class="card mini-stats-wid">
        <div class="card-body">
            <div class="media">
                @php
                  $t_supplier=App\Models\Supplier::where('supplier_status',0)->count();
                @endphp
                <div class="media-body">
                    <p class="text-muted font-weight-medium font-size-18">Supplier</p>
                    <h4 class="mb-0">
                      @if($t_supplier < 10)
                        0{{$t_supplier}}
                      @else
                        {{$t_supplier}}
                      @endif
                    </h4>
                </div>
                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                    <span class="avatar-title bg-dark">
                        <i class="bx bx-trash font-size-24"></i>
                    </span>
                </div>
            </div>
        </div>
        <a href="{{url('dashboard/recycle/supplier')}}" class="btn btn-md btn-dark btn-block btn_block btn_uppercase">View More</a>
    </div>
  </div>

</div>
@endsection
