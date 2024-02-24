<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = [
        'r_time',
        'r_date',
        'people',
        'phone',
        'name',
        'details',
        'status',
        'r_month',
        'r_year',
        'user_id',
    ];
}
