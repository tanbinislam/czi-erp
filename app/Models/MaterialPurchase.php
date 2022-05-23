<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialPurchase extends Model
{
    use HasFactory;

    protected $guarded;
    protected $primaryKey = 'mp_id';
    
    public function joinMaterial(){
      return $this->belongsTo('App\Models\Material', 'material_id', 'material_id');
    }

    public function joinSupplier(){
      return $this->belongsTo('App\Models\Supplier', 'supplier_id', 'supplier_id');
    }

    public function materialDamages()
    {
        return $this->hasMany(Damage::class, 'material_id','material_id');
    }

    public function totalMaterialDamages()
    {
       return $this->materialDamages()->sum('damage_quantity');
    }
    public function materialChanalDamages()
    {
        return $this->hasMany(Damage::class, 'mp_chalan','mp_chalan');
    }

    public function ChanalDamagesQuantity()
    {
        return $this->materialChanalDamages()->sum('damage_quantity');
    }

    public function makeChalanRecipe()
    {
        return $this->hasMany(RecipeMake::class, 'chalan_name','mp_chalan');
    }



    public function totalmakeChalanRecipe()
    {
        return $this->makeChalanRecipe()->sum('quantity');
    }





}
