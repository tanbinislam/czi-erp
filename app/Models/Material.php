<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class Material extends Model
{
    use HasFactory;

    public function materialPurchases()
    {
        return $this->hasMany(MaterialPurchase::class,'material_id','material_id')->where('mp_status',1);
    }

    public function quantity()
    {
        return $this->materialPurchases()->where('mp_status',1)->sum('mp_quantity');
    }

    public function price()
    {
        return $this->materialPurchases()->sum('mp_unit_price'*'mp_quantity');
    }

    public function materialDamages()
    {
        return $this->hasMany(Damage::class, 'material_id','material_id');
    }

    public function materialDamageQuantity()
    {
       return $this->materialDamages()->sum('damage_quantity');
    }

    public function materialStockWithDamage()
    {
        return ( $this->quantity() - $this->materialDamageQuantity());
    }

    public function recipeMake()
    {
        return $this->hasMany(RecipeMake::class, 'material_id','material_id')->where('material_status',1);
    }
    public function recipeMakeQuantity()
    {
        return $this->hasMany(RecipeMake::class, 'material_id','material_id')->sum('quantity');
    }

    public function unusedQuantity()
    {
        return $this->materialStockWithDamage() - $this->recipeMakeQuantity();
    }





}
