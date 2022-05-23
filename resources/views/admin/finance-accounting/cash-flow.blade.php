@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header card_header">
                <div class="row">
                    <div class="col-md-8">
                        <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i> Balance Sheet</h4>
                    </div>
                    {{-- <div class="col-md-4 text-right">
                        <a href="{{url('dashboard/payroll/salary_type/create')}}" class="btn btn-dark btn-md waves-effect btn-label waves-light card_btn"><i class="fas fa-plus-circle label-icon"></i>Add Salary Type</a>
                    </div> --}}
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-7">
                        
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <table id="balance-sheet" class="">
                    <thead class="">
                      <tr>
                          <th style="text-align: center">Particulars</th>
                          <th  style="text-align: right; width:300px">Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><b>Current Assets</b></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Cash In Boxes</td>
                            <td style="text-align: right;">{{'0.00'}}</td>
                        </tr>
                        <tr>
                            <td>Cash in Banks</td>
                            <td style="text-align: right;">{{'0.00'}}</td>
                        </tr>
                        <tr>
                            <td>Account Receivable</td>
                            <td style="text-align: right;">{{'0.00'}}</td>
                        </tr>
                        <tr>
                            <td>Inventory accounts</td>
                            <td style="text-align: right;">{{'0.00'}}</td>
                        </tr>
                        <tr>
                            <td style="text-align: right;"><b>Total Current Assets</b></td>
                            <td style="border: 2px solid black; text-align: right;">{{'0.00'}}</td>
                        </tr>

                        <tr>
                            <td>Fixed Assets</td>
                            <td style="text-align: right;">{{'0.00'}}</td>
                        </tr>
                        <tr>
                            <td style="text-align: right;"><b>Total Fixed Assets</b></td>
                            <td style="border: 2px solid black; text-align: right;">{{'0.00'}}</td>
                        </tr>

                        <tr>
                            <td><b>Current Liabilities</b></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Accounts payable</td>
                            <td style="text-align: right;">{{'0.00'}}</td>
                        </tr>
                        <tr>
                            <td style="text-align: right;"><b>Total Current Liabilities</b></td>
                            <td style="border: 2px solid black; text-align: right;">{{'0.00'}}</td>
                        </tr>

                        <tr>
                            <td>Non-current Liabilities</td>
                            <td style="text-align: right;">{{'0.00'}}</td>
                        </tr>
                        <tr>
                            <td style="text-align: right;"><b>Total Non-current Liabilities</b></td>
                            <td style="border: 2px solid black; text-align: right;">{{'0.00'}}</td>
                        </tr>

                        <tr>
                            <td><b>Sales Revenue</b></td>
                            <td style="text-align: right;">{{'0.00'}}</td>
                        </tr>
                        <tr>
                            <td><b>Other Revenue</b></td>
                            <td style="text-align: right;">{{'0.00'}}</td>
                        </tr>
                        <tr>
                            <td style="text-align: right;"><b>Total Income</b></td>
                            <td style="border: 2px solid black; text-align: right;">{{'0.00'}}</td>
                        </tr>

                        <tr>
                            <td><b>Direct Expenses</b></td>
                            <td style="text-align: right;">{{'0.00'}}</td>
                        </tr>
                        <tr>
                            <td><b>Indirect Expenses</b></td>
                            <td style="text-align: right;">{{'0.00'}}</td>
                        </tr>
                        <tr>
                            <td style="text-align: right;"><b>Total Expense</b></td>
                            <td style="border: 2px solid black; text-align: right;">{{'0.00'}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer card_footer">
              <div class="btn-group mt-2" role="group">
                  <a href="#" class="btn btn-secondary">Print</a>
                  <a href="#" class="btn btn-dark">PDF</a>
                  <a href="#" class="btn btn-secondary">Excel</a>
              </div>
            </div>
        </div>
    </div>
</div>
@push('css')
    <style>
        #balance-sheet{
            width: 100%;
        }

        #balance-sheet thead{
            background-color: #343a40;
            color: #fff;
        }

        #balance-sheet thead tr th{
            padding: 10px 20px;
        }

        #balance-sheet tbody tr td{
            padding: 5px 20px;
            border: 1px solid #343a40;
        }
    </style>    
@endpush
@endsection