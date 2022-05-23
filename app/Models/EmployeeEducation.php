<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeEducation extends Model{
    use HasFactory;

    protected $primaryKey='empedu_id';

    public function creatorInfo(){
      return $this->belongsTo('App\Models\User','empedu_creator','id');
    }

    public function employee()
    {
      return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }
}
