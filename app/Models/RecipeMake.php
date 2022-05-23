<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeMake extends Model
{
    use HasFactory;

    protected $table = 'recipemakes';
    protected $fillable = ['recipe_id','material_id','chalan_name','quantity','date'];

    public function materials()
    {
        return $this->belongsTo(Material::class, 'material_id', 'material_id');
    }

    public function recepie()
    {
        return $this->belongsTo(Recipe::class, 'recipe_id', 'id');
    }


}
