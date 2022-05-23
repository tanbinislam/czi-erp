<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CustomerPaymentController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::where('customer_status',1)->get();
        return view('admin.customer.payment.all',compact('customers'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($slug)
    {
       $customer = Customer::where('customer_slug', $slug)->where('customer_status',1)->firstOrfail();
        return view('admin.customer.payment.add',compact('customer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => ['required'],
            'payable_amount' => ['required'],
            'date' => ['required'],
        ],[
            'customer_id.required' => 'Customer is required!',
            'payable_amount.required' => 'Paid amount is required',
            'date.required' => 'Paid date is required',
        ]);
        $data = $request->all();
        $data['user_id'] = auth()->id();
        $insert = CustomerPayment::create($data);
        if($insert){
            Session::flash('success');
            return redirect('dashboard/customer/payment');
        }else{
            return redirect('dashboard/customer/payment');
            Session::flash('error');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomerPayment  $customerPayment
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerPayment $customerPayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CustomerPayment  $customerPayment
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomerPayment $customerPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CustomerPayment  $customerPayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomerPayment $customerPayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomerPayment  $customerPayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerPayment $customerPayment)
    {
        //
    }
}
