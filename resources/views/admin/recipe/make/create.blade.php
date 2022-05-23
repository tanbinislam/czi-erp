@extends('layouts.admin')
@section('content')

@if(empty(request('recipe') || request('date')) )
    <div class="row">
        <div class="col-12">
            <form method="get" action="#" enctype="multipart/form-data">
                <div class="card">
                    <div class="card-header card_header">
                        <div class="row">
                            <div class="col-md-8">
                                <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i> Make Recipe
                                    Information</h4>
                            </div>
                            <div class="col-md-4 text-right">
                                <a href="{{url('dashboard/recipe-make-list')}}"
                                   class="btn btn-dark btn-md waves-effect btn-label waves-light card_btn"><i
                                        class="fas fa-th label-icon"></i>All Make Recipe</a>
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
                        <div class="form-group row mb-3">

                            <div class="col-sm-5">
                                <label class="col-form-label col_form_label">Recipe name:<span class="req_star">*</span></label>
                                <select required class="form-control" name="recipe">
                                    <option class="form_control" value="">SELECT RECIPE NAME</option>
                                    @foreach($recipes as $recipe)
                                        <option class="form_control"
                                                value="{{$recipe->id}}">{{ $recipe->name ?: ''}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('recipe'))
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('recipe') }}</strong>
                                             </span>
                                @endif
                            </div>
                            <div class="col-sm-4">
                                <label class="col-form-label col_form_label">Date:<span class="req_star">*</span></label>
                                <input required type="text" class="form-control form_control" id="birththday" name="date"
                                       value="{{old('date')}}">
                                @if ($errors->has('date'))
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('date') }}</strong>
                                             </span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <label style="padding-bottom: 18px;" class="col-form-label col_form_label"></label>
                                <div class="pt-2">


                                    <button type="submit" class="btn btn-md btn-dark">SUBMIT</button>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </form>
        </div>
    </div>
@else
    <div class="row">
        <div class="col-12">
            <div class="card">
                    <div class="card-header card_header">
                        <div class="row">
                            <div class="col-md-5">
                                <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i> Make Recipe
                                    Information </h4>
                            </div>
                            <div class="col-md-7 text-right">
                                <a id="addInfoModal" title="add" data-toggle="modal" data-target="#addModal" href="#"
                                   class="btn btn-dark btn-md waves-effect btn-label waves-light card_btn"><i
                                        class="fas fa-plus-square label-icon"></i>Recipe Process items</a>
                                <a href="{{url('dashboard/recipe-make-list')}}"
                                   class="btn btn-dark btn-md waves-effect btn-label waves-light card_btn"><i
                                        class="fas fa-th label-icon"></i>All Make Recipe</a>

                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        <table id="" class="table table-bordered custom_table">
                            <thead class="thead-dark">
                            <tr>
                                <th>Date</th>
                                <th>Material</th>
                                <th>Chalan</th>
                                <th>Quantity</th>
                            </tr>
                            </thead>

                            <tbody >
                            @foreach( $makeRecipes as $makeRecipe)
                            <tr id="form-info">
                                <td>{{ $makeRecipe->date ?: '' }}</td>
                                <td>{{ $makeRecipe->materials->material_name }}</td>
                                <td style="width: 400px" >{{ $makeRecipe->chalan_name ?: '' }}</td>
                                <td>{{ $makeRecipe->quantity ?: '' }}</td>


                                {{--<td>
                                    <a href="#" title="view" id="addrow"><i style="padding-top: 10px;" class="fas fa-plus-square view_icon"></i></a>
                                    <a href="#" title="view" id="removerow"><i class="fas fa-minus-square view_icon"></i></a>
                                </td>--}}

                            </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>

                </div>
        </div>
    </div>
@endif

<!--add information modal start-->
<div id="addModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="post" action="{{url('dashboard/recipe-material-store')}}">
            @csrf

            <input name="recipe_id" hidden value="{{ request('recipe') ?: '' }}">
            <input name="date" hidden value="{{ request('date') ?: '' }}">
            <div class="modal-content">
                <div class="modal-header modal_header_upper">
                    <h5 class="modal-title mt-0" id="myModalLabel"><i class="fab fa-gg-circle"></i>Make Recipe Process</h5>
                </div>
                <div class="modal-body modal_card">
                    {{--<div class="form-group row mb-3 {{ $errors->has('recipe') ? ' has-error' : '' }}">
                        <label class="col-sm-3 col-form-label col_form_label_modal">Recipe Name<span class="req_star">*</span>:</label>
                        <div class="col-sm-7">
                            <select required class="form-control" name="recipe">
                                <option class="form_control" value="">SELECT RECIPE NAME</option>
                                @foreach($recipes as $recipe)
                                    <option class="form_control"
                                            value="{{$recipe->id}}">{{ $recipe->name ?: ''}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('recipe'))
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('recipe') }}</strong>
                                             </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-3 col-form-label col_form_label_modal">Date:</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control form_control_modal" name="quantity" id="chalanQuantity" value="{{old('quantity')}}">
                        </div>
                    </div>--}}
                    <div class="form-group row mb-3 {{ $errors->has('material_id') ? ' has-error' : '' }}">
                        <label class="col-sm-3 col-form-label col_form_label_modal">Material<span class="req_star">*</span>:</label>
                        <div class="col-sm-7">
                            <select class="form-control" id="materialID" name="material_id">
                                <option class="form_control" value="">SELECT MATERIAL</option>
                                @foreach($materials as $material)
                                    <option class="form_control"
                                            value="{{$material->material_id}}">{{$material->material_name}}</option>
                                @endforeach
                                <option class="form_control" value="9999998215">Water</option>
                            </select>
                            @if ($errors->has('material_id'))
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('material_id') }}</strong>
                                             </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-3 {{ $errors->has('chalan_no') ? ' has-error' : '' }}">
                        <label class="col-sm-3 col-form-label col_form_label_modal">Chalan No<span class="req_star">*</span>:</label>
                        <div class="col-sm-7">
                            <select class="form-control chalan_name" name="mp_chalan" id="chalanName">

                            </select>
                            @if ($errors->has('material_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('material_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-3 col-form-label col_form_label_modal">Quantity:</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control form_control_modal" name="quantity" id="chalanQuantity" value="{{old('quantity')}}">
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
        $(document).ready(function () {
            var i = 1;
            $(document).on('click', '#addrow', function () {
                i++;
                var row = $(this).parents('#form-info').clone();

              //  $(row).find("#materialID").attr("id","materialID");

                $(row).find('.chalan_name option').remove();
                /*$(row).find("input[type='number']").val("");*/
                $(this).parents('#form-info').after(row);

            });

            $(document).on('click', '#removerow', function () {
                if (i === 1) return;
                i--;
                var row = $(this).parents('#form-info').remove();
                /*$(row).find("input[type= 'text']").val("");*/
                $(this).parents('#form-info').after(row);
            });
        });

        $(document).ready(function(){
            $("#price, #quantity").keyup(function(){
                var total=0;
                var price = $("#price").val();
                var quantity = $("#quantity").val();
                var total= price*quantity;
                $("#total").val(total);
            });
        });
        $(document).ready(function(){

            $("#materialID").change(function (e) {
                //e.preventDefault();
                if($("#materialID").val() == 9999998215){
                    $('#chalanName').html('<option value="water">Water</option>');
                    $("#chalanQuantity").prop("readonly", false);
                }else{
                    $('.chalan_name').empty();
                    let materialID = $(this).val();
                    $("#chalanQuantity").val(null);
                    $.ajax({
                        method: "post",
                        url: '{{url("dashboard/recipe-material")}}',
                        data: {
                            '_token': ' {{ csrf_token() }}',
                            material_id: materialID
                        },
                        success: function (data) {

                                var html_material_purchases = `<option class="null_material_purchases" value="" default selected>SELECTE CHALAN NAME </option>`;
                                $.each(data.success.material_purchases, function (index, value) {
                                    html_material_purchases += `<option value="` + value.mp_chalan + `">` + value.mp_chalan  + `</option>`;
                                });
                                $('#chalanName').append(html_material_purchases);
                                $("#chalanName").on("change",function (e) {
                                    let chalaName = $(this).val();
                                    let materiNameID = $("#materialID").val();

                                    $.ajax({
                                        method: 'post',
                                        url: '{{ url("dashboard/material/purchase/get-purchase-info") }}',
                                        data: {
                                            '_token': ' {{ csrf_token() }}',
                                            mp_chalan: chalaName,
                                            material_id : materiNameID
                                        },
                                        success:function (response) {
                                            $("#chalanQuantity").val(response);
                                            if (response == 0) {
                                                $("#chalanQuantity").prop("readonly", true);
                                            }else{
                                                $("#chalanQuantity").prop("readonly", false);
                                                let dataVal = response;
                                                $("#chalanQuantity").keyup(function() {
                                                    let inputVal = $("#chalanQuantity").val();

                                                    if ((dataVal >= inputVal) && (dataVal > 0))  {
                                                        $("#chalanQuantity").css({"border": "1px solid green", "color": "green"});
                                                    }else {
                                                        $("#chalanQuantity").css({"border": "1px solid red", "color": "red"});
                                                    }

                                                });
                                            }

                                        }

                                    });
                                })


                        }
                    })
                }
                

                
            })
        });
    </script>
@endpush

