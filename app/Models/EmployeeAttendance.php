<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeAttendance extends Model
{
    use HasFactory;

    protected $fillable = ['intime', 'outtime', 'status', 'employee_id','shift_id', 'date', 'overtime', 'is_holiday'];

    public function employee()
    {
        return $this->hasOne(Employee::class, 'employee_id','employee_id');
    }

    public function shift()
    {
        return $this->hasOne(DailyShift::class, 'id', 'shift_id');
    }
}
