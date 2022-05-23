<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Damage extends Model{
    use HasFactory;

    protected $guarded;
    public function joinMaterial(){
      return $this->belongsTo('App\Models\Material', 'material_id', 'material_id');
    }

    public function totalDamageQuantity()
    {
        return $this->joinMaterial()->sum('damage_quantity');
    }

}
