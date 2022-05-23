<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficialInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'joining_date',
        'salary',
        'reference',
        'salary_type',
    ];
}
