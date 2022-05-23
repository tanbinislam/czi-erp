<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalarySetup extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id','gross_salary','salary_type','official_information_salary','status'];

    public function employees()
    {
        return $this->hasOne(Employee::class, 'employee_id','employee_id');
    }
}
