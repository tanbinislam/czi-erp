@extends('layouts.admin')
@section('content')


    <div class="row">
        <div class="col-12">
            <form id="material_purchase_form" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header card_header">
                        <div class="row">
                            <div class="col-md-8">
                                <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i> Add Purchase
                                    Information</h4>
                            </div>
                            <div class="col-md-4 text-right">
                                <a href="{{url('dashboard/material/purchase')}}"
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
                                <div class="alert alert-success alrts d-none" role="alert">
                                    <strong>Success! Successfully Updated Purchase Information</strong>
                                </div>
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
                                <th></th>
                            </tr>
                            </thead>

                            <tbody id="mat_purchase">
                            
                            @foreach ($all_purchase as $k => $data)
                                <tr class="form-info">
                                    <td>
                                        <select class="form-control" name="material_id[]">
                                            <option class="form_control" value="">SELECT MATERIAL</option>
                                            @foreach($materials as $material)
                                                <option class="form_control"value="{{$material->material_id}}" {{$material->material_id == $data->material_id ? 'selected' : ''}}>{{$material->material_name}}</option>
                                            @endforeach
                                        </select>
                                            <span class="invalid-feedback" role="alert" style="display: block;">
                                                <strong class="err" id="err-material_id-{{$k}}"></strong>
                                             </span>
                                             <input type="hidden" name="p_id" value="{{ $data->mp_id }}">
                                    </td>
                                    <td>
                                        <input type="number" class="form-control form_control " data-fid="{{$k}}" id="quantity_{{$k}}" name="quantity[]" value="{{ $data->mp_quantity }}">
                                            <span class="invalid-feedback" role="alert" style="display: block;">
                                                <strong class="err" id="err-quantity-{{$k}}"></strong>
                                             </span>
                                    </td>
                                    <td>
                                        <input type="number" class="form-control form_control price" data-fid="{{$k}}" id="price_{{$k}}" name="price[]" value="{{ $data->mp_unit_price }}">
                                            <span class="invalid-feedback" role="alert" style="display: block;">
                                                <strong class="err" id="err-price-{{$k}}"></strong>
                                             </span>
                                    </td>
                                    <td>
                                        <input type="number" class="form-control form_control" disabled id="total_{{$k}}" name="mp_total_price" value="{{$data->mp_total_price}}">
                                    </td>
                                    
                                    <td>
                                        @if (auth()->user()->hasRole('Super Admin'))
                                        <a href="#" id="softDelete" title="delete" data-toggle="modal" data-target="#softDelModal" data-id="{{$data->mp_id}}"><i class="fas fa-trash delete_icon"></i></a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="row my-2">
                            <div class="col-12 text-right">
                                <button class="btn btn-dark" id="addrow"><i class="fas fa-plus-square mr-2"></i>Add Item</button>
                            </div>
                        </div>
                        <table class="table table-bordered custom_table">
                            <tbody>
                                <tr>
                                    <td colspan="2">
                                        <label for="">Supplier:<span
                                                class="req_star">*</span></label>
                                        <select class="form-control" name="supplier_id">
                                            <option class="form_control" value="">SELECT NAME</option>
                                            @foreach($suppliers as $supplier)
                                                <option class="form_control" value="{{$supplier->supplier_id}}" {{$supplier->supplier_id == $all_purchase[0]->supplier_id ? 'selected' : ''}}>{{$supplier->supplier_name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="invalid-feedback" role="alert" style="display: block;">
                                            <strong class="err" id="err-supplier"></strong>
                                         </span>
                                    </td>
                                    <td colspan="2">
                                        <label for="">Chalan:<span
                                                class="req_star">*</span></label>
                                        <input disabled type="text" class="form-control form_control" id="chalan"  value="{{ $all_purchase[0]->mp_chalan }}">
                                        <input type="hidden" name="chalan" value="{{ $all_purchase[0]->mp_chalan }}">
                                               <span class="invalid-feedback" role="alert" style="display: block;">
                                                <strong class="err" id="err-chalan"></strong>
                                             </span>
                                    </td>
                                    <td  colspan="1">
                                        <label for="">Voucher:</label>
                                        <input disabled type="text" class="form-control form_control" id="voucher"  value="{{ $all_purchase[0]->mp_voucher }}">
                                        <input  type="hidden" name="voucher" value="{{ $all_purchase[0]->mp_voucher }}">
                                        <span class="invalid-feedback" role="alert" style="display: block;">
                                            <strong class="err" id="err-voucher"></strong>
                                        </span>
                                    </td>
                                    

                                    <td colspan="1">
                                        <label for="">Purchase Date:<span class="req_star">*</span></label>
                                        <input type="date" class="form-control form_control" id="date" name="date" value="{{ $all_purchase[0]->mp_date }}">
                                        <span class="invalid-feedback" role="alert" style="display: block;">
                                            <strong class="err" id="err-mp-date"></strong>
                                         </span>
                                         <input type="hidden" name="slug" value="{{ $all_purchase[0]->mp_slug }}">
                                         <input type="hidden" name="count" value="{{ $all_purchase->count() }}">
                                    </td>
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
    <!--softdelete modal start-->
<div id="softDelModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form method="post" action="{{url('dashboard/material/purchase/softdelete')}}">
        @csrf
        <div class="modal-content">
          <div class="modal-header modal_header">
              <h5 class="modal-title mt-0" id="myModalLabel"><i class="fab fa-gg-circle"></i> Confirm Message</h5>
          </div>
          <div class="modal-body modal_card">
            Are you sure you want to delete?
            <input type="hidden" id="modal_id" name="modal_id">
          </div>
          <div class="modal-footer">
              <button type="submit" class="btn btn-md btn-dark waves-effect waves-light">Confirm</button>
              <button type="button" class="btn btn-md btn-danger waves-effect" data-dismiss="modal">Close</button>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $.ajaxSetup({ headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')} });
        $(document).ready(function () {
            var i = '{{$all_purchase->count()}}';
            $(document).on('click', '#addrow', function (e) {
                e.preventDefault();
                //i++;
                var row = '<tr class="form-info">'+
                                '<td>'+
                                    '<select class="form-control" name="material_id[]">'+
                                        '<option class="form_control" value="">SELECT MATERIAL</option>'+
                                        '@foreach($materials as $material)'+
                                            '<option class="form_control"value="{{$material->material_id}}">{{$material->material_name}}</option>'+
                                       ' @endforeach'+
                                    '</select>'+
                                        '<span class="invalid-feedback" role="alert" style="display: block;">'+
                                            '<strong class="err" id="err-material_id-'+i+'"></strong>'+
                                        '</span>'+
                                '</td>'+
                                '<td>'+
                                    '<input type="number" class="form-control form_control quantity" data-fid="'+i+'" id="quantity_'+i+'" name="quantity[]" value="">'+
                                        '<span class="invalid-feedback" role="alert" style="display: block;">'+
                                            '<strong class="err" id="err-quantity-'+i+'"></strong>'+
                                        '</span>'+
                                '</td>'+
                                '<td>'+
                                    '<input type="number" class="form-control form_control price" data-fid="'+i+'" id="price_'+i+'" name="price[]" value="">'+
                                        '<span class="invalid-feedback" role="alert" style="display: block;">'+
                                            '<strong class="err" id="err-price-'+i+'"></strong>'+
                                        '</span>'+
                                '</td>'+
                                '<td>'+
                                    '<input type="number" class="form-control form_control" disabled id="total_'+i+'" name="mp_total_price" value="">'+
                                '</td>'+
                                '<td class="removerow" style="cursor: pointer">'+
                                    '<i class="fas fa-minus-square view_icon"></i>'+
                                '</td>'+
                            '</tr>';

                $("#mat_purchase").append(row); 
                i++;           
            });

            $("#mat_purchase").on('click', '.removerow', function(e){
                e.preventDefault();
                $(this).parent().remove();
            });

            $("#mat_purchase").on('keyup', ".price, .quantity", function(){
                var id = $(this).data('fid');
                var total=0;
                var price = $("#price_"+id).val();
                var quantity = $("#quantity_"+id).val();
                var total= price*quantity;
                $("#total_"+id).val(total);
            });
            
        });
        var base_url = window.location.origin;
        $("#material_purchase_form").on('submit', function(e){
            e.preventDefault();
            $(".err").text('');
            $.ajax({
                type: 'post',
                url: base_url+'/dashboard/material/purchase/update',
                data: $('#material_purchase_form').serializeArray(),
                success: function(response){
                    $('.alrts').removeClass('d-none');
                    setTimeout(function() {
                        $('.alrts').slideUp(1000);
                        window.location.href = base_url+"/dashboard/material/purchase/";
                    },5000);
                },
                error: function(response){
                    // console.log(response)
                    $("#err-chalan").text(response.responseJSON.errors.chalan)
                    $("#err-voucher").text(response.responseJSON.errors.voucher)
                    $("#err-mp-date").text(response.responseJSON.errors.date)
                    $("#err-supplier").text(response.responseJSON.errors.supplier_id)
                    $.each(response.responseJSON.errors, function( index, value ) {
                        var er = index.split('.');
                        // console.log(er);
                        if(er.length > 1){
                             console.log(er, response.responseJSON.errors[er.join('.')]);
                            $("#err-"+er[0]+'-'+er[1]).text(response.responseJSON.errors[er.join('.')])
                        }
                    });
                }
            })
        });

    </script>
@endpush