<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use HasFactory;

    protected $fillable = [
        'designation_id',
        'designation_name',
        'designation_remarks',
        'designation_creator',
        'designation_slug',
        'designation_status',
    ];
}
