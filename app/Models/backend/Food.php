<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;
    protected $table = 'food'; 
    protected $fillable = [
        'category_id',
        'subcategory_id',
        'name',
        'slug',
        'tags',
        'price',
        'discount_price',
        'image',
        'description',
        'user_id',
        'date',
        'month',
        'year',
        'status',
        'top',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
    }
}
