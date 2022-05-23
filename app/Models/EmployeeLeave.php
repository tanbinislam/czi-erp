<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeLeave extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'leave_from',
        'leave_to',
        'leave_reason',
        'leave_slug',
        'status',
    ];

    protected $casts = [
        'leave_from' => 'date',
        'leave_to' => 'date',
    ];

    public function employee()
    {
      return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }
}
