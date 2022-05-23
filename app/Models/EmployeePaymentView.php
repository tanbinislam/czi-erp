<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeePaymentView extends Model
{
    use HasFactory;

    const PAY = 101;
    const PAID = 111;
    protected $fillable = [
        'employee_id',
        'total_salary',
        'month',
        'ds_date',
        'bonus',
        'overtime_salary',
        'working_hour',
        'working_period',
        'is_pay',
        'user_id',
        'payment_type',
        'status'];

    public function employee()
    {
        return $this->hasOne(Employee::class, 'employee_id','employee_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id','user_id');
    }


}
