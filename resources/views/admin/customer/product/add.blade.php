@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-12">
      <form method="post" action="{{url('dashboard/customer/product-deliver')}}" enctype="multipart/form-data">
        @csrf
          <input hidden value="{{ $customer->customer_id }}" name="customer_id" >
        <div class="card">
            <div class="card-header card_header">
                <div class="row">
                    <div class="col-md-8">
                        <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i> Add Customer Product sell Information</h4>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="{{url('dashboard/customer/product-deliver')}}" class="btn btn-dark btn-md waves-effect btn-label waves-light card_btn"><i class="fas fa-th label-icon"></i>All Customer Product</a>
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
              <div class="form-group row mb-3 {{ $errors->has('name') ? ' has-error' : '' }}">
                <label class="col-sm-3 col-form-label col_form_label">Product Name<span class="req_star">*</span>:</label>
                <div class="col-sm-7">
                    <select type="text" class="form-control form_control" id="productName" name="recipe_product_id" >
                        <option value=''>Select Product</option>
                        @foreach( $products as $product)
                            <option value='{{ $product->id }}'>{{ $product->name }}</option>
                        @endforeach

                    </select>
                  @if ($errors->has('name'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('name') }}</strong>
                      </span>
                  @endif
                </div>
              </div>
                <div class="form-group row mb-3 {{ $errors->has('quantity') ? ' has-error' : '' }}">
                    <label class="col-sm-3 col-form-label col_form_label"> Quantity:<span class="req_star"></span>:</label>
                    <div class="col-sm-7">
                        <input min="0" type="number" class="form-control form_control" id="quantity" name="quantity" value="{{old('quantity')}}">
                        <strong id="massage" class="text-danger d-none"></strong>
                        @if ($errors->has('quantity'))
                            <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('quantity') }}</strong>
                      </span>
                        @endif
                    </div>
                </div>

              <div class="form-group row mb-3 {{ $errors->has('price') ? ' has-error' : '' }}">
                <label class="col-sm-3 col-form-label col_form_label">Unit Price<span class="req_star">*</span>:</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control form_control" name="price" value="{{old('price')}}">

                  @if ($errors->has('price'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('price') }}</strong>
                      </span>
                  @endif
                </div>
              </div>

              <div class="form-group row mb-3 {{ $errors->has('purchase_date') ? ' has-error' : '' }}">
                <label class="col-sm-3 col-form-label col_form_label">Purchase Date<span class="req_star">*</span>:</label>
                <div class="col-sm-7">
                  <input type="date" class="form-control form_control" name="purchase_date" value="{{old('purchase_date')}}">

                  @if ($errors->has('purchase_date'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('purchase_date') }}</strong>
                      </span>
                  @endif
                </div>
              </div>

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
            $("#productName").on("change",function () {
                let product_id = $(this).val();

                $.ajax({
                    url: '{{ url("dashboard/customer/get-make-product-item") }}',
                    method: 'post',
                    data: {
                        '_token': ' {{ csrf_token() }}',
                        recipe_product_id: product_id
                    },
                    success:function (response) {
                        console.log(response);
                        $("#quantity").val(response.available_stock);
                        $("#quantity").attr('max', response.available_stock);
                        if (response.available_stock == 0) {
                            $("#massage").addClass('d-block').html("Out Of Stock!");
                        }else{
                            $("#massage").removeClass('d-block');
                            let dataVal = response.available_stock;
                            $("#quantity").on('change', function() {
                               setTimeout(function () {
                                   let inputVal = $("#quantity").val();
                                   if ((dataVal >= inputVal) && (dataVal > 0))  {
                                       $("#quantity").css({"border": "1px solid green", "color": "green"});
                                       $("#massage").removeClass('d-block');
                                   }else {
                                       $("#quantity").css({"border": "1px solid red", "color": "red"});
                                       $("#massage").addClass('d-block').html("Product quantity exceeded stock. Quantity stock is "+ dataVal);
                                   }
                               },1)

                            });
                        }

                    }

                });
            })
        })
    </script>
@endpush
{{--
$.ajax({
url: '{{ url("dashboard/customer/get-make-product-item") }}',
method: 'post',
data: {
'_token': ' {{ csrf_token() }}',
made_recipe_product_id: product_id
},

});--}}
