@extends('layouts.admin')
@section('content')
      <div class="row">
          <div class="col-12">
              <div class="card">
                  <div class="card-header card_header">
                      <div class="row">
                          <div class="col-md-8">
                              <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i> Cash Balance Summary</h4>
                          </div>
                          <div class="col-md-4 text-right">
                              <a href="{{url('dashboard/income/add')}}" class="btn btn-dark btn-md waves-effect btn-label waves-light card_btn"><i class="fas fa-plus-circle label-icon"></i>Add Income</a>
                              <a href="{{url('dashboard/expense/add')}}" class="btn btn-dark btn-md waves-effect btn-label waves-light card_btn"><i class="fas fa-plus-circle label-icon"></i>Add Expense</a>
                          </div>
                      </div>
                  </div>
                  <div class="card-body">
                      <div class="row pb-2">
                          <div class="col-md-4">
                            <div class="input-group">
                              <input type="text" class="form-control form_control" id="datepickerFrom" name="from">
                              <div class="input-group-append">
                                  <span class="input-group-text"><i class="mdi mdi-calendar"></i><b>From</b></span>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="input-group">
                              <input type="text" class="form-control form_control" id="datepickerTo" name="to">
                              <div class="input-group-append">
                                  <span class="input-group-text"><i class="mdi mdi-calendar"></i><b>To</b></span>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-2">
                            <div class="input-group">
                                <input type="button" class="btn btn-dark btn-md waves-effect waves-light card_btn" id="search" value="SEARCH">
                            </div>
                          </div>
                      </div>
                      <table id="inexsummary" class="table table-bordered table-striped table-hover dt-responsive nowrap custom_table">
                          <thead class="thead-dark">
                            <tr>
                              <th>Date</th>
                              <th>Title</th>
                              <th>Category</th>
                              <th>Debit</th>
                              <th>Credit</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($incomes as $data)
                            <tr>
                                <td>{{$data->income_date}}</td>
                                <td>{{$data->income_details}}</td>
                                <td>{{$data->joinInCat->in_cat_name}}</td>
                                <td>{{$data->income_amount}}</td>
                                <td>---</td>
                            </tr>
                            @endforeach
                            @foreach($expense as $data)
                            <tr>
                                <td>{{$data->expens_date}}</td>
                                <td>{{$data->expens_details}}</td>
                                <td>{{$data->joinExCat->exp_cat_name}}</td>
                                <td>---</td>
                                <td>{{$data->expens_amount}}</td>
                            </tr>
                            @endforeach
                          </tbody>
                          <tfoot>
                              <tr>
                                  <th></th>
                                  <th></th>
                                  <th class="details" style="text-align: right;">Total</th>
                                  <th>{{$incomeTotal}}</th>
                                  <th>{{$expenseTotal}}</th>
                              </tr>
                              <tr>
                                  <th class="text-center" colspan="5">
                                      Total Saving:
                                      @if($incomeTotal > $expenseTotal)
                                      <span style="color: green;">{{$incomeTotal-$expenseTotal}}</span>
                                      @else
                                      <span style="color: red;">{{$incomeTotal-$expenseTotal}}</span>
                                      @endif
                                  </th>
                              </tr>
                          </tfoot>
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
      </div>

@endsection
