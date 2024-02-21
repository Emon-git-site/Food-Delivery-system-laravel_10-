<?php

namespace App\Models\backend;

use App\Models\backend\hrm\Department;
use App\Models\backend\hrm\Designation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'department_id',
        'designation_id',
        'image',
        'name',
        'phone',
        'address',
        'gender',
        'blood',
        'nid',
        'joining_date',
        'salary',
        'status',
    ];

    // join with department
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    // join with designation
    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
