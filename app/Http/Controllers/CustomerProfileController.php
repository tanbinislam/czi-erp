<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerProfileController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index($profileSlug)
    {
        $customer = Customer::with('buyMadeProducts.products','paymentView.user')->where('customer_slug', $profileSlug)->where('customer_status', 1)->firstOrFail();
        return view('admin.customer.profile.overview',compact('customer'));

    }
}
