<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name',
        'category_slug'
    ];
    
    // public function subcategory()
    // {
    //     return $this->hasMany(Subcategory::class, 'category_id');
    // }
}
