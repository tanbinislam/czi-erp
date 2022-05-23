@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-12">
      <form method="post" action="{{url('dashboard/material/damage/update')}}" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header card_header">
                <div class="row">
                    <div class="col-md-8">
                        <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i> Edit Damage Information</h4>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="{{url('dashboard/material/damage')}}" class="btn btn-dark btn-md waves-effect btn-label waves-light card_btn"><i class="fas fa-th label-icon"></i>All Damage</a>
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
              <div class="form-group row mb-3 {{ $errors->has('material') ? ' has-error' : '' }}">
                <label class="col-sm-3 col-form-label col_form_label">Material Name:</label>
                <div class="col-sm-5">
                  @php
                    $materials=App\Models\Material::where('material_status',1)->get();
                  @endphp
                  <select class="form-control" name="material_id" >
                    <option class="form_control">SELECT MATERIAL</option>
                    @foreach($materials as $material)
                    <option class="form_control" value="{{$material->material_id}}"{{($data->material_id==$material->material_id)?"selected":''}}>{{$material->material_name}}</option>
                    @endforeach
                  </select>
                  @if ($errors->has('material_id'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('material_id') }}</strong>
                      </span>
                  @endif
                </div>
              </div>
                <div class="form-group row mb-3 {{ $errors->has('mp_id') ? ' has-error' : '' }}">
                  <label class="col-sm-3 col-form-label col_form_label">Chalan No:</label>
                  <div class="col-sm-5">
                    <select class="form-control" name="mp_id">
                      <option>{{$data->mp_chalan}}</option>
                    </select>
                    @if ($errors->has('mp_id'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('mp_id') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>
                  <div class="form-group row mb-3 {{ $errors->has('quantity') ? ' has-error' : '' }}">
                    <label class="col-sm-3 col-form-label col_form_label">Quantity:<span class="req_star">*</span></label>
                    <div class="col-sm-5">
                      <input type="hidden" name="id" value="{{$data->damage_id}}">
                      <input type="number" class="form-control form_control" name="quantity" value="{{$data->damage_quantity}}">
                      @if ($errors->has('quantity'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('quantity') }}</strong>
                          </span>
                      @endif
                    </div>
                  </div>
              <div class="form-group row mb-3">
                <label class="col-sm-3 col-form-label col_form_label">Remarks:<span class="req_star"></span></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control form_control" name="remarks" value="{{$data->damage_remarks}}">
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
