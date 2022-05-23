@extends('admin.account.profile')
@section('account-info')
<div class="card">
    <div class="card-header card_header">
        <div class="row">
            <div class="col-md-12">
                <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i> My Account Information</h4>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-nowrap table-hover mb-0">
                <tbody>
                    <tr> 
                        <td class="text-right">Photo</td>
                        <td>:</td>
                        <td><img src="{{is_null(Auth::user()->photo) ? asset('uploads/avatar/avatar-black.png') : asset('uploads/users/'.Auth::user()->photo)}}" alt="" class="avatar-md rounded-circle img-thumbnail"></td>
                    </tr>

                    <tr>
                        <td class="text-right">Name</td>
                        <td>:</td>
                        <td>{{ auth()->user()->name }}</td>
                    </tr>
                    <tr>
                        <td class="text-right">Phone</td>
                        <td>:</td>
                        <td>{{ auth()->user()->phone }}</td>
                    </tr>
                    <tr>
                        <td class="text-right">Email</td>
                        <td>:</td>
                        <td>{{ auth()->user()->email }}</td>
                    </tr>
                    <tr>
                        <td class="text-right">Role</td>
                        <td>:</td>
                        <td>{{ auth()->user()->roles[0]->name }}</td>
                    </tr>
                    <tr>
                        <td class="text-right">Registration Time</td>
                        <td>:</td>
                        <td>{{ auth()->user()->created_at->format('d-m-Y') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer card_footer">
    </div>
</div>
@endsection