@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header card_header">
                <div class="row">
                    <div class="col-md-8">
                        <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i> All Accounts Information</h4>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="#" id="addAccounts" title="add" data-toggle="modal" data-target="#accountsModal" class="btn btn-dark btn-md waves-effect btn-label waves-light card_btn"><i class="fas fa-plus-circle label-icon"></i>Add Accounts Information</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-7">
                        @if(Session::has('success'))
                          <div class="alert alert-success alertsuccess" role="alert">
                             <strong>Success! Successfully Insert Accounts Information</strong> {{Session::get('success')}}
                          </div>
                        @endif
                        @if(Session::has('upSuccess'))
                          <div class="alert alert-success alertsuccess" role="alert">
                             <strong>Success! Successfully Update Accounts Information</strong> {{Session::get('success')}}
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
                <table id="alltableinfo" class="table table-bordered table-striped table-hover dt-responsive nowrap custom_table">
                    <thead class="thead-dark">
                      <tr>
                          <th>Month-Year</th>
                          <th>Cash In Banks</th>
                          <th>Cash In Hands</th>
                          <th>Fixed Assets</th>
                          <th>Long Term Liabilities</th>
                          <th>Manage</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($accounts as $data)
                      <tr>
                          <td>{{date('M-Y', strtotime($data->month))}}</td>
                          <td>{{$data->cash_in_banks}}</td>
                          <td>{{$data->cash_in_boxes}}</td>
                          <td>{{ $data->fixed_assets }}</td>
                          <td>{{ $data->non_current_liabilities }}</td>
                          <td>
                              <a data-slug="{{$data->slug}}" data-toggle="modal" data-target="#accountsModal" href='#' class="editAccounts" title="edit"><i class="fas fa-pen-square edit_icon"></i></a>
                          </td>
                      </tr>
                      @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer card_footer">
              {{-- <div class="btn-group mt-2" role="group">
                  <a href="#" class="btn btn-secondary">Print</a>
                  <a href="#" class="btn btn-dark">PDF</a>
                  <a href="#" class="btn btn-secondary">Excel</a>
              </div> --}}
            </div>
        </div>
    </div>
</div>
<!-- Accounts Modal -->
<div class="modal fade" id="accountsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="accountsForm" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header modal_header_upper">
                    <h5 class="modal-title mt-0" id="myModalLabel"><i class="fab fa-gg-circle"></i>Accounts Information</h5>
                </div>
                <div class="modal-body modal_card">
                    <div class="form-group row mb-3 {{ $errors->has('month') ? ' has-error' : '' }}">
                        <label class="col-sm-3 col-form-label col_form_label_modal">Month-Year<span class="req_star">*</span>:</label>
                        <div class="col-sm-7">
                            <input type="month" class="form-control form_control_modal" name="month" id="month" value="{{old('month')}}">
                            @if ($errors->has('month'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('month') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-3 {{ $errors->has('cash_in_banks') ? ' has-error' : '' }}">
                        <label class="col-sm-3 col-form-label col_form_label_modal">Cash In Banks<span class="req_star">*</span>:</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control form_control_modal" name="cash_in_banks" id="cash_in_banks" value="{{old('cash_in_banks')}}">
                            @if ($errors->has('cash_in_banks'))
                                <span class="invalid-feedback" role="alert" style="display: block;">
                                    <strong>{{ $errors->first('cash_in_banks') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-3 {{ $errors->has('cash_in_boxes') ? ' has-error' : '' }}">
                        <label class="col-sm-3 col-form-label col_form_label_modal">Cash In Hands<span class="req_star">*</span>:</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control form_control_modal" name="cash_in_boxes" id="cash_in_boxes" value="{{old('cash_in_boxes')}}">
                            @if ($errors->has('cash_in_boxes'))
                                <span class="invalid-feedback" role="alert" style="display: block;">
                                    <strong>{{ $errors->first('cash_in_boxes') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-3 {{ $errors->has('fixed_assets') ? ' has-error' : '' }}">
                        <label class="col-sm-3 col-form-label col_form_label_modal">Fixed Assets<span class="req_star">*</span>:</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control form_control_modal" name="fixed_assets" id="fixed_assets" value="{{old('fixed_assets')}}">
                            @if ($errors->has('fixed_assets'))
                                <span class="invalid-feedback" role="alert" style="display: block;">
                                    <strong>{{ $errors->first('fixed_assets') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-3 {{ $errors->has('non_current_liabilities') ? ' has-error' : '' }}">
                        <label class="col-sm-3 col-form-label col_form_label_modal">Long Term Liabilities<span class="req_star">*</span>:</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control form_control_modal" name="non_current_liabilities" id="non_current_liabilities" value="{{old('non_current_liabilities')}}">
                            @if ($errors->has('non_current_liabilities'))
                                <span class="invalid-feedback" role="alert" style="display: block;">
                                    <strong>{{ $errors->first('non_current_liabilities') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer modal_footer">
                    <button type="submit" class="btn btn-md btn-dark waves-effect waves-light">SUBMIT</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            var base_url = window.location.origin;

            $('#addAccounts').on('click', function(){
                $("#accountsForm").attr('action', '/dashboard/accounts-info/submit');
                $('#month').val('');
                $('#cash_in_banks, #cash_in_boxes, #fixed_assets, #non_current_liabilities').val(0)
            });
            $('.editAccounts').on('click', function(){
                var slug = $(this).data('slug');
                $("#accountsForm").attr('action', base_url+'/dashboard/accounts-info/update/'+slug);                
                $.ajax({
                    url: base_url+'/dashboard/accounts-info/edit/'+slug,
                    method: 'GET',
                    success: function(accounts){
                        $('#month').val(accounts.data.month);
                        $('#cash_in_banks').val(accounts.data.cash_in_banks);
                        $('#cash_in_boxes').val(accounts.data.cash_in_boxes);
                        $('#fixed_assets').val(accounts.data.fixed_assets);
                        $('#non_current_liabilities').val(accounts.data.non_current_liabilities);
                    }
                });
            })
        });
    </script>
@endpush
