<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website_setting extends Model
{
    use HasFactory;
    protected $fillable = [
        'currency',
        'phone_one',
        'phone_two',
        'main_email',
        'support_email',
        'logo',
        'favicon',
        'address',
        'twitter',
        'instagram',
        'linkedin',
        'youtube',
    ];
}
