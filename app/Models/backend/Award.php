<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'award_name',
        'award_date',
        'award_month',
        'award_year',
        'details',
        'award',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id'); 
    }
}
