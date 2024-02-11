<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expensetype extends Model
{
    use HasFactory;
    protected $fillable = [
        'type_name',
    ];
}
