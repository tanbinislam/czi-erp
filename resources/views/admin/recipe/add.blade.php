@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-12">
      <form method="post" action="{{url('dashboard/recipe')}}" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header card_header">
                <div class="row">
                    <div class="col-md-8">
                        <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i> Add Recipe Information</h4>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="{{url('dashboard/recipe')}}" class="btn btn-dark btn-md waves-effect btn-label waves-light card_btn"><i class="fas fa-th label-icon"></i>All Recipe</a>
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
                    <label class="col-sm-3 col-form-label col_form_label">Recipe name:<span class="req_star">*</span></label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control form_control" id="name" name="name" value="{{old('name')}}">
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

<script type="text/javascript">
  $(document).ready(function(){
    $('select[name="material_id"]').on('change',function(){
      var material_id= $(this).val();
      // alert(material_id);
      if(material_id){
        $.ajax({
          url:"{{url('dashboard/material/damage/ajax')}}/"+material_id,
          type:"GET",
          dataType:"json",
          success:function(data){
            var d = $('select[name="mp_id"]').empty();
              $.each(data, function(key, value){
                  $('select[name="mp_id"]').append('<option value="'+value.mp_chalan+'">'+value.mp_chalan+'</option>');
              });
          }
        });
      }
    });

  });
</script>
@endsection
