@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header card_header">
                <div class="row">
                    <div class="col-12">
                        <form method="GET" action="{{ url('/dashboard/balance-sheet/')}}">
                            <div class="row pb-2">
                                <div class="col-md-2 card-title card_title">
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input type="date" class="form-control form_control" name="from" value="{{ date('Y-m-d', strtotime($starting_date)) }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i><b>From</b></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input type="date" class="form-control form_control" name="to" value="{{ date('Y-m-d', strtotime($ending_date)) }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i><b>To</b></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <input type="submit" class="btn btn-dark btn-md waves-effect waves-light card_btn" value="SEARCH">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="balance_sheet" class="card">
            <div class="card-header card_header">
                <div class="row">
                    <div class="col-md-8">
                        <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i> Balance Sheet: From <span class="text-danger">{{ date('d-M-Y', strtotime($starting_date)) }}</span> <span class="tospan">to</span> <span class="text-danger">{{ date('d-M-Y', strtotime($ending_date)) }}</h4>
                    </div>
                    <div class="col-md-4 text-right">
                    </div>
                </div>
            </div>
            <div class="card-body">
                
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
                            <td>Cash In Hands</td>
                            <td style="text-align: right;">{{ number_format($cash_in_boxes, 2) }} TK</td>
                        </tr>
                        <tr>
                            <td>Cash in Banks</td>
                            <td style="text-align: right;">{{ number_format($cash_in_banks, 2) }} TK</td>
                        </tr>
                        <tr>
                            <td>Account Receivable</td>
                            <td style="text-align: right;">{{ number_format($account_receivable, 2) }} TK</td>
                        </tr>
                        <tr>
                            <td>Inventory accounts</td>
                            <td style="text-align: right;">{{ number_format($inventory_accounts, 2) }} TK</td>
                        </tr>
                        <tr>
                            <td style="text-align: right;"><b>Total Current Assets</b></td>
                            <td style="border: 2px solid black; text-align: right;"><b>{{ number_format(($cash_in_boxes + $cash_in_banks + $account_receivable + $inventory_accounts), 2) }} TK</b></td>
                        </tr>

                        <tr>
                            <td>Fixed Assets</td>
                            <td style="text-align: right;">{{ number_format($fixed_assets, 2) }} TK</td>
                        </tr>
                        <tr>
                            <td style="text-align: right;"><b>Total Fixed Assets</b></td>
                            <td style="border: 2px solid black; text-align: right;"><b>{{ number_format($fixed_assets, 2) }} TK</b></td>
                        </tr>

                        <tr>
                            <td><b>Current Liabilities</b></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Accounts payable</td>
                            <td style="text-align: right;">{{ number_format($accounts_payable, 2) }} TK</td>
                        </tr>
                        <tr>
                            <td style="text-align: right;"><b>Total Current Liabilities</b></td>
                            <td style="border: 2px solid black; text-align: right;"><b>{{ number_format($accounts_payable, 2) }} TK</b></td>
                        </tr>

                        <tr>
                            <td>Long Term Liabilities</td>
                            <td style="text-align: right;">{{ number_format($non_current_liabilities, 2) }} TK</td>
                        </tr>
                        <tr>
                            <td style="text-align: right;"><b>Total Long Term Liabilities</b></td>
                            <td style="border: 2px solid black; text-align: right;"><b>{{ number_format($non_current_liabilities, 2) }} TK</b></td>
                        </tr>

                        <tr>
                            <td><b>Sales Revenue</b></td>
                            <td style="text-align: right;">{{ number_format($sales_revenue, 2) }} TK</td>
                        </tr>
                        <tr>
                            <td><b>Other Revenue</b></td>
                            <td style="text-align: right;">{{ number_format($other_revenue, 2) }} TK</td>
                        </tr>
                        <tr>
                            <td style="text-align: right;"><b>Total Income</b></td>
                            <td style="border: 2px solid black; text-align: right;"><b>{{ number_format(($sales_revenue + $other_revenue), 2) }} TK</b></td>
                        </tr>

                        <tr>
                            <td><b>Direct Expenses</b></td>
                            <td style="text-align: right;">{{ number_format($direct_expenses, 2) }} TK</td>
                        </tr>
                        <tr>
                            <td><b>Indirect Expenses</b></td>
                            <td style="text-align: right;">{{ number_format($indirect_expenses, 2) }} TK</td>
                        </tr>
                        <tr>
                            <td style="text-align: right;"><b>Total Expense</b></td>
                            <td style="border: 2px solid black; text-align: right;"><b>{{ number_format(($direct_expenses + $indirect_expenses), 2) }} TK</b></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer card_footer">
              <div class="btn-group mt-2" role="group">
                  <a id="print-btn" href="#" onclick="window.print();" class="btn btn-dark">PRINT</a>
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
            background-color: #000;
            color: #fff;
        }

        #balance-sheet thead tr th{
            padding: 10px 20px;
        }

        #balance-sheet tbody tr td{
            padding: 5px 20px;
            border: 1px solid #343a40;
        }

        @media print {
            body * {
                visibility: hidden;
            }
            #balance_sheet, #balance_sheet *, #balance-sheet, #balance-sheet * {
                visibility: visible;
            }
            #print-btn{
                visibility: hidden;
            }

            #balance-sheet thead{
            background-color: #000;
            color: #fff;
            }
            /* #balance_sheet {
                position: absolute;
                left: 0;
                top: 0;
            } */
        }
    </style>    
@endpush
@push('scripts')
    <script>
        function printDiv() {   

            var divToPrint=document.getElementById('balance_sheet');

            var newWin=window.open('','Print-Window');

            newWin.document.open();

            newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

            newWin.document.close();

            setTimeout(function(){newWin.close();},10);

        }
    </script>
@endpush
@endsection