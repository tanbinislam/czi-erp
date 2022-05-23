<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    public function materialSupply()
    {
        return $this->hasMany(MaterialPurchase::class, 'supplier_id', 'supplier_id');
    }

    public function totalPrice()
    {
        return $this->materialSupply()->sum('mp_total_price');
    }
    
    public function supplyPayment()
    {
        return $this->hasMany(SupplierPayment::class,'supplier_id','supplier_id');
    }

    public function totalPayablePrice()
    {
        return $this->hasMany(SupplierPayment::class,'supplier_id','supplier_id')->sum('payable_amount');
    }





}
