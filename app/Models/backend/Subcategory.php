<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'category_id',
        'subcategory_name',
        'subcategory_slug',
        'image',
    ];
}
