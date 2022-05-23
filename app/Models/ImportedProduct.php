<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportedProduct extends Model
{
    use HasFactory;

    public function stock()
    {
        return $this->hasMany(ImportedProductStock::class);
    }
}
