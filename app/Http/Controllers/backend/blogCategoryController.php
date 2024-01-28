<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class blogCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
}
