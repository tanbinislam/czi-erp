@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-12">
      <form method="post" action="{{url('dashboard/expense/update')}}" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header card_header">
                <div class="row">
                    <div class="col-md-8">
                        <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i> Edit Expense Information</h4>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="{{url('dashboard/expense')}}" class="btn btn-dark btn-md waves-effect btn-label waves-light card_btn"><i class="fas fa-th label-icon"></i>All Expense</a>
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
              <div class="form-group row mb-3 {{ $errors->has('exp_cat_id') ? ' has-error' : '' }}">
                <label class="col-sm-3 col-form-label col_form_label">Category Name:<span class="req_star">*</span></label>
                <div class="col-sm-5">
                  @php
                    $exCategory=App\Models\ExpenseCategory::where('exp_cat_status',1)->get();
                  @endphp
                  <select class="form-control" name="exp_cat_id" >
                    <option class="form_control" value="">SELECT CATEGORY</option>
                    @foreach($exCategory as $category)
                    <option class="form_control" value="{{$category->exp_cat_id}}" {{($data->exp_cat_id==$category->exp_cat_id)?"selected":''}}>{{$category->exp_cat_name}}</option>
                    @endforeach
                  </select>
                  @if ($errors->has('exp_cat_id'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('exp_cat_id') }}</strong>
                      </span>
                  @endif
                </div>
              </div>
              <div class="form-group row mb-3 {{ $errors->has('details') ? ' has-error' : '' }}">
                <label class="col-sm-3 col-form-label col_form_label">Details:<span class="req_star">*</span></label>
                <div class="col-sm-5">
                  <input type="hidden" name="id" value="{{$data->expens_id}}">
                  <input type="text" class="form-control form_control" name="details" value="{{$data->expens_details}}">
                  @if($errors->has('details'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('details') }}</strong>
                      </span>
                  @endif
                </div>
              </div>
                <div class="form-group row mb-3 {{ $errors->has('amount') ? ' has-error' : '' }}">
                  <label class="col-sm-3 col-form-label col_form_label">Amount:<span class="req_star">*</span></label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control form_control" name="amount" value="{{$data->expens_amount}}">
                    @if ($errors->has('amount'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('amount') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>
              <div class="form-group row mb-3 {{ $errors->has('date') ? ' has-error' : '' }}">
                <label class="col-sm-3 col-form-label col_form_label">Expense Date:<span class="req_star">*</span></label>
                <div class="col-sm-5">
                  <div class="input-group">
                    <input type="text" class="form-control form_control" id="birththday" name="date" value="{{$data->expens_date}}">
                    @if ($errors->has('date'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('date') }}</strong>
                        </span>
                    @endif
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer card_footer text-center">
                <button type="submit" class="btn btn-md btn-dark">UPDATE</button>
            </div>
        </div>
      </form>
    </div>
</div>
@endsection
