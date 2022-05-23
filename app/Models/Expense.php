<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model{
    use HasFactory;

    public function joinExCat(){
      return $this->belongsTo('App\Models\ExpenseCategory', 'exp_cat_id', 'exp_cat_id');
    }
}
