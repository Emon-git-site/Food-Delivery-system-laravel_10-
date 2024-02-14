<?php

namespace App\Models\backend;

use App\Models\backend\Expensetype;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Expense extends Model
{
    use HasFactory;
    protected $fillable = [
        'expensetype_id',
        'amount',
        'details',
        'month',
        'date',
        'year',
        'user',
    ];
    public function expensetype()
    {
        return $this->belongsTo(Expensetype::class, 'expensetype_id');
    }
}
