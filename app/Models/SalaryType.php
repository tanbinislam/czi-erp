<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryType extends Model
{
    use HasFactory;

    const ADD = 100;
    const DEDUCT = 101;
    protected $fillable = ['name','type'];
}
