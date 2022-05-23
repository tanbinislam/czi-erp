<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $primaryKey = 'customer_id';

    public function buyMadeProducts()
    {
        return $this->hasMany(CoustomerBuyProduct::class, 'customer_id', 'customer_id');
    }

    public function totalPrice()
    {
        return $this->buyMadeProducts->sum(function ($sellDetail) {
            return $sellDetail->price * $sellDetail->quantity;
        });
    }

    public function paymentView()
    {
      return  $this->hasMany(CustomerPayment::class, 'customer_id', 'customer_id');
    }

    public function totalPayablePrice()
    {
        return $this->paymentView()->sum('payable_amount');
    }


}
