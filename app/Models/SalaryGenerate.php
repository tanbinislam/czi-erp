<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryGenerate extends Model
{
    use HasFactory;

    protected $fillable = ['name','generate_date','user_id'];

    public function generateBy()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}
