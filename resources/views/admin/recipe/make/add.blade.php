@extends('layouts.admin')
@section('content')


    <div class="row">
        <div class="col-12">
            <form method="post" action="{{url('#')}}" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header card_header">
                        <div class="row">
                            <div class="col-md-8">
                                <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i> Add Purchase
                                    Information</h4>
                            </div>
                            <div class="col-md-4 text-right">
                                <a href="{{url('#')}}"
                                   class="btn btn-dark btn-md waves-effect btn-label waves-light card_btn"><i
                                        class="fas fa-th label-icon"></i>All Purchase</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-7">
                                @if(Session::has('success'))
                                    <div class="alert alert-success alertsuccess" role="alert">
                                        <strong>Success!</strong> {{Session::get('success')}}
                                    </div>
                                @endif
                                @if(Session::has('error'))
                                    <div class="alert alert-danger alerterror" role="alert">
                                        <strong>Opps!</strong> {{Session::get('error')}}
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                        <table id="" class="table table-bordered custom_table">
                            <thead class="thead-dark">
                            <tr>
                                <th>Material</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total price</th>
                                <th>Purchase Date</th>
                                <th>Manage</th>
                            </tr>
                            </thead>

                            <tbody >
                                <tr id="form-info">
                                    <td colspan="1">
                                        <select class="form-control" name="material_id[]">
                                            <option class="form_control" value="">SELECT MATERIAL</option>
                                            {{--@foreach($materials as $material)
                                                <option class="form_control"
                                                        value="{{$material->material_id}}">{{$material->material_name}}</option>
                                            @endforeach--}}
                                        </select>
                                        @if ($errors->has('material_id'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('material_id') }}</strong>
                                             </span>
                                        @endif

                                    </td>
                                    <td><input type="number" class="form-control form_control" id="quantity" name="quantity[]"
                                               value="{{old('quantity')}}">
                                        @if ($errors->has('quantity'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('quantity') }}</strong>
                                             </span>
                                        @endif</td>
                                    <td><input type="number" class="form-control form_control" id="price" name="price[]"
                                               value="{{old('price')}}"></td>
                                    <td><input id="total" type="number" class="form-control form_control"disabled id="mp_total_price" name="mp_total_price"
                                               value=""></td>

                                    <td> <input type="text" class="form-control form_control" id="birththday" name="date[]"
                                                value="{{old('date')}}"></td>
                                    <td>
                                        <a href="#" title="view" id="addrow"><i style="padding-top: 10px;" class="fas fa-plus-square view_icon"></i></a>
                                        <a href="#" title="view" id="removerow"><i class="fas fa-minus-square view_icon"></i></a>
                                    </td>

                                </tr>
                            </tbody>
                            <tbody>

                            <tr>
                                <td colspan="2">
                                    <label for="">Supplier:<span
                                            class="req_star">*</span></label>
                                    <select class="form-control" name="supplier_id">
                                        <option class="form_control" value="">SELECT NAME</option>
                                       {{-- @foreach($suppliers as $supplier)
                                            <option class="form_control"
                                                    value="{{$supplier->supplier_id}}">{{$supplier->supplier_name}}</option>
                                        @endforeach--}}
                                    </select>
                                </td>
                                <td colspan="2">
                                    <label for="">Chalan:<span
                                            class="req_star">*</span></label>
                                    <input type="text" class="form-control form_control" id="chalan" name="chalan"
                                           value="{{old('chalan')}}">
                                </td>
                                <td  colspan="2"><label for="">Voucher:<span
                                            class="req_star">*</span></label>
                                    <input type="text" class="form-control form_control" id="voucher" name="voucher"
                                           value="{{old('voucher')}}"></td>

                            </tr>

                            </tbody>
                        </table>

                    </div>
                    <div class="card-footer card_footer text-center">
                        <button type="submit" class="btn btn-md btn-dark">SUBMIT</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            var i = 1;
            $(document).on('click', '#addrow', function () {
                i++;
                var row = $(this).parents('#form-info').clone();
                /*$(row).find("input[type='text']").val("");
                $(row).find("input[type='file']").val("");*/
                $(this).parents('#form-info').after(row);
            });

            $(document).on('click', '#removerow', function () {
                if (i === 1) return;
                i--;
                var row = $(this).parents('#form-info').remove();
                /*$(row).find("input[type= 'text']").val("");*/
                $(this).parents('#form-info').after(row);
            });
        });

        $(document).ready(function(){
            $("#price, #quantity").keyup(function(){
                var total=0;
                var price = $("#price").val();
                var quantity = $("#quantity").val();
                var total= price*quantity;
                $("#total").val(total);
            });
        });
    </script>
@endpush

