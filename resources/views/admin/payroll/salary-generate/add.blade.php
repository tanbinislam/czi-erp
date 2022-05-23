@extends('layouts.admin')
@push('css')
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css">
@endpush()
@section('content')
<div class="row">
    <div class="col-12">
      <form method="post" action="{{url('dashboard/payroll/create_salary_generate')}}" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header card_header">
                <div class="row">
                    <div class="col-md-8">
                        <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i> Add Salary Generate</h4>
                    </div>
                    {{--<div class="col-md-4 text-right">
                        <a href="{{url('dashboard/payroll/salary_type')}}" class="btn btn-dark btn-md waves-effect btn-label waves-light card_btn"><i class="fas fa-th label-icon"></i>All Salary Type</a>
                    </div>--}}
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
                <label class="col-sm-3 col-form-label col_form_label">Salary Month <span class="req_star">*</span>:</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control form_control" name="name" value="{{old('name')}}">
                  @if ($errors->has('name'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('name') }}</strong>
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
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header card_header">
                <div class="row">
                    <div class="col-md-8">
                        <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i> All SALARY GENERATE</h4>
                    </div>

                </div>
            </div>
            <div class="card-body">

                <table id="alltableinfo" class="table table-bordered table-striped table-hover dt-responsive nowrap custom_table">
                    <thead class="thead-dark">
                    <tr>
                        <th>Salary Name </th>
                        <th>Generate Date</th>
                        <th>Generate By</th>
                        <th>Manage</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($all as $data)
                        <tr>
                            <td>{{ date('F Y',strtotime($data->name)) ?: ''}}</td>
                            <td>{{ date('d-M-Y',strtotime($data->generate_date)) ?: '' }}</td>
                            <td>{{ isset($data->generateBy) ? $data->generateBy->name: '' }}</td>
                            <td>
                                <a href='{{url("dashboard/payroll/create_salary_generate/$data->id/edit")}}' title="edit"><i class="fas fa-pen-square edit_icon"></i></a>
                                <a href="#" id="softDelete" title="delete" data-toggle="modal" data-target="#softDelModal" data-id="{{$data->designation_id}}"><i class="fas fa-trash delete_icon"></i></a>
                            </td>
                        </tr>
                    @endforeach
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
@endsection
@push('scripts')
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{ url('contents/admin/assets/js/pages/jquery.mtz.monthpicker.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('input').monthpicker();
        });
    </script>
@endpush
