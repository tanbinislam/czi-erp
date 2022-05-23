@extends('layouts.admin')
@section('content')
<div class="row">
  <div class="col-lg-12">
      <div class="card">
          <div class="card-body">
              <div class="invoice-title">
                  <h4 class="float-right font-size-16"></h4>
                  <div class="mb-4">
                      @php
                          $basic = \App\Models\Basic::where('basic_id', 1)->sole();
                          $contact = \App\Models\ContactInformation::where('cont_id', 1)->sole();
                      @endphp
                      <img src="{{is_null($basic->basic_logo) ? asset('contents/admin/assets/images/logo-dark.png') : asset('uploads/basic/'.$basic->basic_logo) }}" alt="logo" height="60"/>
                  </div>
              </div>
              <hr>
              <div class="row">
                  <div class="col-sm-6">
                      <address>
                          <strong>Paid To:</strong><br>
                          <strong>Name:</strong> {{ $employee->employee_name }}<br>
                          <strong>Designation:</strong> {{ $employee->designation->designation_name }}<br>
                          <strong>Address:</strong> {{$employee->employee_address}}
                      </address>
                  </div>
                  <div class="col-sm-6 text-sm-right">
                      <address class="mt-2 mt-sm-0">
                          From: <strong>{{ $basic->basic_company }}</strong><br>
                          Paid by: {{$employeePaymentView->user->name}}<br>
                          Address:{{$contact->cont_add1}}
                      </address>
                  </div>
              </div>
              <div class="row">
                  <div class="col-sm-6 mt-3">
                      <address>
                          <strong>Payment Method:</strong><br>
                          {{ $employeePaymentView->payment_type == 101 ? 'Cash' : 'Bank' }}
                      </address>
                  </div>
                  <div class="col-sm-6 mt-3 text-sm-right">
                      <address>
                          <strong>Payment Date:</strong><br>
                          {{ date('d-m-Y',strtotime($employeePaymentView->updated_at)) ?: '' }}<br>
                      </address>
                  </div>
              </div>
              <div class="py-2 mt-3">
                <p><span class="font-size-15 font-weight-bold">Payment summary: </span> {{ is_null($employeePaymentView->month) ? date('d-m-Y', strtotime($employeePaymentView->ds_date)) : date('M-Y', strtotime($employeePaymentView->month)) }}</p>
            </div>
              <div class="table-responsive">
                  <table class="table table-nowrap">
                      <thead>
                          <tr>
                              <th style="width: 70px;">No.</th>
                              <th>Item</th>
                              <th class="text-right">Amounts</th>
                          </tr>
                      </thead>
                      <tbody>
                          <tr>
                              <td>01</td>
                              <td>Basic Salary</td>
                              <td class="text-right">TK. {{ number_format(isset($employeePaymentView->employee)? $employeePaymentView->employee->official ? $employeePaymentView->employee->official->salary : '' : '', 2)}}</td>
                          </tr>

                          <tr>
                              <td>02</td>
                              <td>Gross Salary</td>
                              <td class="text-right"TK. >{{ number_format(isset($employeePaymentView->employee)? $employeePaymentView->employee->salarySetups ? $employeePaymentView->employee->salarySetups->gross_salary : '' : '', 2)}}</td>
                          </tr>

                          <tr>
                            <td>03</td>
                            <td>Overtime Salary</td>
                            <td class="text-right"TK. >{{ number_format($employeePaymentView->overtime_salary, 2) }}</td>
                        </tr>

                          <tr>
                              <td>04</td>
                              <td>Bonus</td>
                              <td class="text-right">TK. {{ number_format($employeePaymentView->bonus, 2) }}</td>
                          </tr>
                          
                          
                          <tr>
                              <td colspan="2" class="border-0 text-right">
                                  <strong>Total</strong></td>
                              <td class="border-0 text-right"><h4 class="m-0">TK. {{ number_format($employeePaymentView->total_salary, 2) }}</h4></td>
                          </tr>
                      </tbody>
                  </table>
              </div>
              <div class="d-print-none">
                  <div class="float-right">
                      <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light mr-1"><i class="fa fa-print"></i> Print</a>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection
