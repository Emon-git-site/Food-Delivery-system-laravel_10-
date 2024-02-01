<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class table extends Model
{
    use HasFactory;
    protected $fillable = [
        'floor_id',
        'table_code',
        'table_sit',
    ];

    public function floor()
    {
        return $this->belongsTo(Floor::class, 'floor_id');
    }
}
