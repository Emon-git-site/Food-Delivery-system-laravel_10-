<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class holiday extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'name',
        'from',
        'to',
        'num_of_days',
        'month',
        'year',
    ];
}
