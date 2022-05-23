@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header card_header">
                <div class="row">
                    <div class="col-md-8">
                        <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i> All Recipe Made Product Information</h4>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="#" id="addProduct" title="add" data-toggle="modal" data-target="#recipeModal" class="btn btn-dark btn-md waves-effect btn-label waves-light card_btn"><i class="fas fa-plus-circle label-icon"></i>Add Recipe Made Product</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-7">
                        @if(Session::has('success'))
                          <div class="alert alert-success alertsuccess" role="alert">
                             <strong>Success! Successfully Insert Recipe Product price Information</strong> {{Session::get('success')}}
                          </div>
                        @endif
                        @if(Session::has('softSuccess'))
                          <div class="alert alert-success alertsuccess" role="alert">
                             <strong>Success! Successfully Insert Recipe Information</strong> {{Session::get('success')}}
                          </div>
                        @endif
                        @if(Session::has('upSuccess'))
                          <div class="alert alert-success alertsuccess" role="alert">
                             <strong>Success! Successfully Update Recipe Information</strong> {{Session::get('success')}}
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
                          <th>Production Date</th>
                          <th>Product name</th>
                          <th>Recipe Name</th>
                          <th>Product Quantity</th>
                          <th>Product Price</th>
                          <th>Manage</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($all as $data)
                      <tr>
                          <td>{{$data->date}}</td>
                          <td>{{$data->recipeProduct->name}}</td>
                          <td>{{$data->recipe->name}}</td>
                          <td>{{ $data->quantity ?: '' }}</td>
                          <td>{{  $data->price ?: ''  }}</td>
                          <td>
                              <a data-slug="{{$data->slug}}" data-toggle="modal" data-target="#recipeModal" href='#' class="editProduct" title="edit"><i class="fas fa-pen-square edit_icon"></i></a>
                              @if (auth()->user()->hasRole('Super Admin'))
                              <a href="#" id="softDelete" title="delete" data-toggle="modal" data-target="#softDelModal" data-id=" {{$data->id }}"><i class="fas fa-trash delete_icon"></i></a>    
                              @endif
                              
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
<!--softdelete modal start-->
<!--softdelete modal start-->
<div id="softDelModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post" action="{{url('dashboard/recipe-product/softdelete')}}">
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

<div class="modal fade" id="recipeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="productForm" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header modal_header_upper">
                    <h5 class="modal-title mt-0" id="myModalLabel"><i class="fab fa-gg-circle"></i>Make Recipe Process</h5>
                </div>
                <div class="modal-body modal_card">
                    <div class="form-group row mb-3 {{ $errors->has('recipe') ? ' has-error' : '' }}">
                        <label class="col-sm-3 col-form-label col_form_label_modal">Recipe Name<span class="req_star">*</span>:</label>
                        <div class="col-sm-7">
                            <select required class="form-control" name="recipe" id="recipe">
                                <option class="form_control" value="">SELECT RECIPE NAME</option>
                                @foreach($recipes as $recipe)
                                    <option class="form_control" value="{{$recipe->id}}">{{ $recipe->name ?: ''}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('recipe'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('recipe') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-3 {{ $errors->has('product') ? ' has-error' : '' }}">
                        <label class="col-sm-3 col-form-label col_form_label_modal">Product Name<span class="req_star">*</span>:</label>
                        <div class="col-sm-7">
                            <select required class="form-control" name="product" id="product">
                                <option class="form_control" value="">SELECT PRODUCT NAME</option>
                                @foreach($products as $product)
                                    <option class="form_control" value="{{$product->id}}">{{ $product->name ?: ''}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('product'))
                                <span class="invalid-feedback" role="alert" style="display: block;">
                                    <strong>{{ $errors->first('product') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-3 {{ $errors->has('date') ? ' has-error' : '' }}">
                        <label class="col-sm-3 col-form-label col_form_label_modal">Production Date<span class="req_star">*</span>:</label>
                        <div class="col-sm-7">
                            <select required class="form-control" name="date" disabled="disabled" id="date">
                                <option class="form_control" value="">SELECT DATE</option>
                            </select>
                            @if ($errors->has('product'))
                                <span class="invalid-feedback" role="alert" style="display: block;">
                                    <strong>{{ $errors->first('product') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-3 col-form-label col_form_label_modal">Product Quantity<span class="req_star">*</span>:</label>
                        <div class="col-sm-7">
                            <input min="0" type="number" class="form-control form_control_modal" name="quantity" id="productQuantity" value="{{old('quantity')}}">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-3 col-form-label col_form_label_modal">Product Price<span class="req_star">*</span>:</label>
                        <div class="col-sm-7">
                            <input min="0" type="number" class="form-control form_control_modal" name="price" id="productPrice" value="{{old('price')}}">
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
            
            $(document).on("click", "#recipeID", function () {
                var deleteID = $(this).data('id');
                $("#recipe_id").val( deleteID );
            });
            
            $("#recipe").on('change', function(){
                
                var recipe_id = $(this).val();
                $("#date").html('<option class="form_control" value="">SELECT DATE</option>');
                $.ajax({
                    url: base_url+'/dashboard/recipe-product/get-dates/'+recipe_id,
                    method: 'GET',
                    success: function(response){
                        $("#date").removeAttr('disabled');
                        console.log(response);
                        $.each(response.data, function(index, value){
                            $("#date").append('<option class="form_control" value="'+value+'">'+value+'</option>')
                        });
                    }
                });
            });

            $('#addProduct').on('click', function(){
                $("#productForm").attr('action', '/dashboard/recipe-product/store');

                $('select#recipe').find('option').each(function() {
                    $(this).removeAttr('selected');
                });

                $('select#product').find('option').each(function() {
                    $(this).removeAttr('selected');
                });

                $("#date").html('<option class="form_control" value="">SELECT DATE</option>');
                
                $('#productQuantity').val(0)
                
                $('#productPrice').val(0)
            });
            $('.editProduct').on('click', function(){
                var slug = $(this).data('slug');
                $("#productForm").attr('action', base_url+'/dashboard/recipe-product/update/'+slug);                
                $.ajax({
                    url: base_url+'/dashboard/recipe-product/get-product/'+slug,
                    method: 'GET',
                    success: function(product){
                        // console.log(product);
                        $('select#recipe').find('option').each(function() {
                            $(this).val() == product.data.recipe_id ? $(this).attr('selected','selected') : '';
                        });
                        $('select#product').find('option').each(function() {
                            $(this).val() == product.data.recipe_product_id ? $(this).attr('selected','selected') : '';
                        });
                        $.ajax({
                            url: base_url+'/dashboard/recipe-product/get-dates/'+product.data.recipe_id,
                            method: 'GET',
                            success: function(response){
                                $("#date").removeAttr('disabled');
                                $.each(response.data, function(index, value){
                                    $("#date").append('<option class="form_control" value="'+value+'"'+(value == product.data.date ? 'selected' : '')+'>'+value+'</option>')
                                });
                            }
                        });
                        
                        $('#productQuantity').val(product.data.quantity)
                        $('#productPrice').val(product.data.price)
                       
                    }
                });
            })
        });
    </script>
@endpush
