<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountDetail extends Model
{
    use HasFactory;

    protected $fillable = ['month', 'cash_in_banks', 'cash_in_boxes', 'fixed_assets', 'non_current_liabilities', 'slug'];
}
