<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable =['designation_id'];

    public function contact(){
        return $this->belongsTo(EmployeeContact::class, 'employee_id', 'employee_id')->where('status',1);
    }

    public function document(){
        return $this->hasMany(EmployeeDocument::class, 'employee_id', 'employee_id')->where('status',1);
    }

    public function attendances()
    {
        return $this->hasMany(EmployeeAttendance::class, 'employee_id', 'employee_id');
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class,'designation_id','designation_id');
    }

    public function official()
    {
        return $this->belongsTo(OfficialInformation::class, 'employee_id', 'employee_id');
    }

    public function salarySetups()
    {
        return $this->belongsTo(SalarySetup::class, 'employee_id', 'employee_id');
    }

    public function salaryPayment()
    {
        return $this->hasMany(EmployeePaymentView::class, 'employee_id', 'employee_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class,'department_id','department_id');
    }

    public function blood()
    {
        return $this->belongsTo(BloodGroup::class,'blood_id','blood_id');
    }

}
