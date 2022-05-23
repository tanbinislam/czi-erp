@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-12">
      <form method="post" action="{{url('dashboard/imported-product/stock-purchase/submit')}}" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header card_header">
                <div class="row">
                    <div class="col-md-8">
                        <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i> Add Imported Product Stock Information</h4>
                    </div>
                    <div class="col-md-4 text-right">
                        {{-- <a href="{{url('dashboard/imported-product')}}" class="btn btn-dark btn-md waves-effect btn-label waves-light card_btn"><i class="fas fa-th label-icon"></i>All Product</a> --}}
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
              <div class="form-group row mb-3 {{ $errors->has('imp_product') ? ' has-error' : '' }}">
                <label class="col-sm-3 col-form-label col_form_label">Product Name:<span class="req_star">*</span></label>
                <div class="col-sm-7">
                  <select class="form-control" name="imp_product" >
                    <option class="form_control" value="">Select Product</option>
                    @foreach($products as $product)
                    <option class="form_control" value="{{$product->id}}">{{$product->name}}</option>
                    @endforeach
                  </select>
                  @if($errors->has('imp_product'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('imp_product') }}</strong>
                      </span>
                  @endif
                </div>
              </div>
              <div class="form-group row mb-3">
                <label class="col-sm-3 col-form-label col_form_label">Purchase Date<span class="req_star">*</span>:</label>
                <div class="col-sm-7">
                  <input type="date" class="form-control form_control" name="date" value="{{old('date')}}">
                  @if($errors->has('date'))
                      <span class="invalid-feedback" role="alert" style="display: block">
                          <strong>{{ $errors->first('date') }}</strong>
                      </span>
                  @endif
                </div>
              </div>
              <div class="form-group row mb-3">
                <label class="col-sm-3 col-form-label col_form_label">Purchase Quantity<span class="req_star">*</span>:</label>
                <div class="col-sm-7">
                  <input type="number" min="0" step="0.01" class="form-control form_control" name="qty" value="{{old('qty')}}">
                  @if($errors->has('qty'))
                      <span class="invalid-feedback" role="alert" style="display: block">
                          <strong>{{ $errors->first('qty') }}</strong>
                      </span>
                  @endif
                </div>
              </div>
              <div class="form-group row mb-3">
                <label class="col-sm-3 col-form-label col_form_label">Price Per Unit<span class="req_star">*</span>:</label>
                <div class="col-sm-7">
                  <input type="number" min="0" step="0.01" class="form-control form_control" name="price" value="{{old('price')}}">
                  @if($errors->has('price'))
                      <span class="invalid-feedback" role="alert" style="display: block">
                          <strong>{{ $errors->first('price') }}</strong>
                      </span>
                  @endif
                </div>
              </div>
              <div class="form-group row mb-3">
                <label class="col-sm-3 col-form-label col_form_label">Chalan (Optional):</label>
                <div class="col-sm-7">
                  <input type="number" min="0" step="0.01" class="form-control form_control" name="chalan" value="{{old('chalan')}}">
                  @if($errors->has('chalan'))
                      <span class="invalid-feedback" role="alert" style="display: block">
                          <strong>{{ $errors->first('chalan') }}</strong>
                      </span>
                  @endif
                </div>
              </div>
              <div class="form-group row mb-3">
                <label class="col-sm-3 col-form-label col_form_label">Voucher (Optional):</label>
                <div class="col-sm-7">
                  <input type="number" min="0" step="0.01" class="form-control form_control" name="voucher" value="{{old('voucher')}}">
                  @if($errors->has('voucher'))
                      <span class="invalid-feedback" role="alert" style="display: block">
                          <strong>{{ $errors->first('voucher') }}</strong>
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
