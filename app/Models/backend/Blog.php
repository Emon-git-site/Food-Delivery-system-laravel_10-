<?php

namespace App\Models\backend;

use App\Models\backend\Blogcategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'title',
        'title_slug',
        'image',
        'description',
        'user_id',
        'created_date',
        'created_month',
    ];

    public function blogcategory()
    {
        return $this->belongsTo(Blogcategory::class, 'category_id');
    }
}
