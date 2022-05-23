@extends('admin.account.profile')
@section('account-info')
<div class="card">
    <div class="card-header card_header">
        <div class="row">
            <div class="col-md-12">
                <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i> Update Password</h4>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form method="post" action="{{ url('/dashboard/account/update-password/'.$slug) }}">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="row mb-2">
                        <label class="col-sm-3 col-form-label col_form_label">Old Password<span class="req_star">*</span>:</label>
                        <div class="col-sm-7">
                            <input type="password" class="form-control form_control" name="old_pass" value="">
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="row mb-2">
                        <label class="col-sm-3 col-form-label col_form_label">Password<span class="req_star">*</span>:</label>
                        <div class="col-sm-7">
                            <input type="password" class="form-control form_control" name="password" value="">
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="row mb-2">
                        <label class="col-sm-3 col-form-label col_form_label">Confirm-Password<span class="req_star">*</span>:</label>
                        <div class="col-sm-7">
                            <input type="password" class="form-control form_control" id="password_confirmation" name="password_confirmation" value="">
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-sm-12 text-center">
                            <input type="submit" class="btn btn-md btn-dark" value="Change Password"/>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card-footer card_footer">
    </div>
</div>
@endsection