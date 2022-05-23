<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Supplier Report</title>
    <link rel="shortcut icon" href="{{asset('contents/admin')}}/assets/images/csl-icon.png">
    <link rel="stylesheet" href="{{asset('contents/admin')}}/assets/css/bootstrap.min.css" id="bootstrap-style"/>
    <link rel="stylesheet" href="{{asset('contents/admin')}}/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css"/>
    <link rel="stylesheet" href="{{asset('contents/admin')}}/assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="{{asset('contents/admin')}}/assets/css/icons.min.css"/>
    <link rel="stylesheet" href="{{asset('contents/admin')}}/assets/css/app.min.css" id="app-style"/>
    <link rel="stylesheet" href="{{asset('contents/admin')}}/assets/css/style.css"/>
    <style>
        table{
            width: 100%;
        }

        table thead{
            background-color: #343a40;
            color: #fff;
        }

        table thead tr th{
            padding: 15px 20px;
        }

        table tbody tr td{
            padding: 10px 20px;
        }

        @media print {
            #print-btn{
                visibility: hidden;
            }
        }
    </style>    
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center text-uppercase text-success">Supplier Report: {{date('d-F-Y', time())}}</h4>
                    </div>
                </div>
                
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <span style="font-size: 16px"><strong>ID:</strong> {{ $supplier->supplier_slug }}</span><br>
                            <span style="font-size: 16px"><strong>Name:</strong> {{ $supplier->supplier_name }}</span><br>
                            <span style="font-size: 16px"><strong>Company:</strong> {{ $supplier->supplier_company }}</span><br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 text-sm-right">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <span style="font-size: 16px"><strong>Phone:</strong> {{ $supplier->supplier_phone }}</span><br>
                            <span style="font-size: 16px"><strong>Website:</strong> {{ $supplier->supplier_website }}</span><br>
                            <span style="font-size: 16px"><strong>Address:</strong> {{ $supplier->supplier_address }}</span><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card_header">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i>Material Supply Report</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @if(isset($supplier))
                                <div class="col-md-12">
                                    <table id="alltableinfo" class="">
                                        <thead class="thead-dark">
                                        <tr>
                                            <th>Purchase Date</th>
                                            <th>Chalan</th>
                                            <th>Material Name</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Total Price</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($supplier->materialSupply as $data)
                                            <tr>
                                                <td>{{ date('d-M,Y',strtotime($data->mp_date)) }}</td>
                                                <td>{{ $data->mp_chalan ?: '' }}</td>
                                                <td>{{ isset($data->joinMaterial) ?$data->joinMaterial->material_name : ''  }}</td>
                                                <td>{{ $data->mp_quantity ?: '' }}</td>
                                                <td>{{ number_format($data->mp_unit_price ?: '', 2) }} TK</td>
                                                <td>{{ number_format($data->mp_total_price ?: '', 2) }} TK</td>
                                            </tr>
            
                                        @endforeach
            
                                        <tr style="background-color: #343a40">
                                            <td colspan="5" class="text-center"><strong
                                                style="font-size: 20px; color:#fff">Total Price</strong></td>
                                            <td colspan="2" style="font-size: 18px; color:rgb(10, 143, 76)"><strong>{{ number_format(isset($supplier) ? $supplier->totalPrice() :'', 2) }} TK</strong>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @endif
            
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header card_header">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i>Supplier Payment Summery</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @if(isset($supplier))
                                <div class="col-md-12">
                                    <table id="alltableinfo" class="">
                                        <thead class="thead-dark">
                                        <tr>
                                            <th>Total Price</th>
                                            <th>Due Price</th>
                                            <th>Payable Price</th>
                                            <th>Total Paid</th>
                                        </tr>
                                        </thead>
                                        <tbody>
            
                                        <tr>
                                            <td>{{ number_format(isset($supplier) ? $supplier->totalPrice() :'', 2) }} TK</td>
                                            <td><strong
                                                    class="text-danger">{{ number_format(($supplier->previous_due_amount + $supplier->totalPrice())-$supplier->totalPayablePrice(), 2) }} TK</strong>
                                            </td>
                                            <td>{{ ($supplier->previous_due_amount + $supplier->totalPrice())-$supplier->totalPayablePrice() }} TK</td>
                                            <td>{{ number_format($supplier->totalPayablePrice(), 2) }} TK</td>
                                        </tr>
            
            
                                        <tr style="background-color: #343a40">
                                            <td colspan="3" class="text-center" ><strong
                                                style="font-size: 20px; color:#fff">Total Paid</strong></td>
                                            <td colspan="2" style="font-size: 18px; color:rgb(10, 143, 76)">
                                                <strong>{{ number_format(isset($supplier) ? $supplier->totalPayablePrice() :'', 2) }} TK</strong></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @endif
            
                        </div>
                    </div>
            
                </div>
                <div class="card">
                    <div class="card-header card_header">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i> Supplier Payment Report</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @if(isset($supplier))
                                <div class="col-md-12">
                                    <table id="alltableinfo" class="" style="width: 100%">
                                        <thead class="" >
                                        <tr>
                                            <th>Paid Date</th>
                                            <th>Paid Price</th>
                                            <th>Paid By</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($supplier->supplyPayment as $payment)
                                            <tr>
                                                <td>{{ $payment->paid_date }}</td>
                                                <td>{{ number_format($payment->payable_amount, 2) }} TK</td>
                                                <td>{{ isset($payment->user) ? $payment->user->name : '' }}</td>
                                            </tr>
                                            @endforeach
            
                                            <tr style="background-color: #343a40">
                                                <td colspan="1" class="text-right"><strong
                                                        style="font-size: 20px; color:#fff">Total Paid</strong></td>
                                                <td colspan="2" style="font-size: 18px; color:rgb(10, 143, 76)">
                                                    <strong>{{ isset($supplier) ? $supplier->totalPayablePrice() :'' }} TK</strong>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
            
                    </div>
                    <div class="card-footer card_footer">
                        <div class="btn-group mt-2" role="group">
                            <a id="print-btn" href="javascript:window.print()" class="btn btn-dark">PRINT</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>