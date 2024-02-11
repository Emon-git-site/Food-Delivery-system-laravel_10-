<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    protected $fillable = [
        'type_name',
    ];
    public function expensetype()
    {
        return $this->belongsTo(Expensetype::class, 'expensetype_id');
    }
}
