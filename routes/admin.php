<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\backend\blogController;
use App\Http\Controllers\backend\FoodController;
use App\Http\Controllers\backend\adminController;
use App\Http\Controllers\backend\AttendanceController;
use App\Http\Controllers\backend\AwardController;
use App\Http\Controllers\backend\floorController;
use App\Http\Controllers\backend\tableController;
use App\Http\Controllers\backend\ExpenseController;
use App\Http\Controllers\backend\BeverageController;
use App\Http\Controllers\backend\categoryController;
use App\Http\Controllers\backend\customerController;
use App\Http\Controllers\backend\ExpensetypeController;
use App\Http\Controllers\backend\reservationController;
use App\Http\Controllers\backend\subcategoryController;
use App\Http\Controllers\backend\blogCategoryController;
use App\Http\Controllers\backend\CustomerCommentController;
use App\Http\Controllers\backend\EmployeeController;
use App\Http\Controllers\backend\HolidayController;
use App\Http\Controllers\backend\hrm\DepartmentController;
use App\Http\Controllers\backend\hrm\DesignationController;
use App\Http\Controllers\backend\LeaveController;
use App\Http\Controllers\backend\LeavetypeController;
use App\Http\Controllers\Website_settingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// admin authentication
Route::prefix('admin')->name('admin.')->group(function () {
    Route::view('/login',  'backend.auth.admin_login')->name('login_form');
    Route::view('/register', 'backend.auth.admin_register')->name('register_form');
    Route::post('/login/owner', [adminController::class, 'adminlogin'])->name('login');
    Route::post('/register', [adminController::class, 'adminregister'])->name('register');
    Route::get('/dashboard', [adminController::class, 'dashboard'])->name('dashboard')->middleware('admin');
    Route::get('/logout', [adminController::class, 'adminlogout'])->name('logout')->middleware('admin');
});

Route::name('profile.')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('destroy');
});

// category routes
Route::prefix('category/')->name('category.')->group(function () {
    Route::get('index', [categoryController::class, 'index'])->name('index');

    // ajax purpose
    Route::get('categoryShow', [categoryController::class, 'categoryShow'])->name('categoryShow');
    Route::post('store', [categoryController::class, 'store'])->name('store');
    Route::get('edit/{id}', [categoryController::class, 'edit']);
    Route::post('update/{id}', [categoryController::class, 'update']);
    Route::get('delete/{id}', [categoryController::class, 'destroy'])->name('delete');
});

// subcategory routes
Route::prefix('subcategory/')->name('subcategory.')->group(function () {
    Route::get('index', [subcategoryController::class, 'index'])->name('index');
    Route::post('store', [subcategoryController::class, 'store'])->name('store');
    Route::get('edit/{id}', [subcategoryController::class, 'edit']);
    Route::post('update/{id}', [subcategoryController::class, 'update']);
    Route::get('delete/{id}', [subcategoryController::class, 'destroy'])->name('delete');
});

// Beverage  routes
Route::prefix('admin/beverage/')->middleware('admin')->name('admin.beverage.')->group(function () {
    Route::get('index', [BeverageController::class, 'index'])->name('index');
    Route::post('store', [BeverageController::class, 'store'])->name('store');
    Route::get('edit/{id}', [BeverageController::class, 'edit']);
    Route::post('update', [BeverageController::class, 'update'])->name('update');
    Route::get('delete/{id}', [BeverageController::class, 'destroy'])->name('delete');
});

// Blog category routes
Route::prefix('admin/blogCategory/')->name('admin.blogCategory.')->group(function () {
    Route::get('index', [blogCategoryController::class, 'index'])->name('index');
    Route::post('store', [blogCategoryController::class, 'store'])->name('store');
    Route::get('edit/{id}', [blogCategoryController::class, 'edit']);
    Route::post('update/{id}', [blogCategoryController::class, 'update']);
    Route::get('delete/{id}', [blogCategoryController::class, 'destroy'])->name('delete');
});

// Blog post routes
Route::prefix('admin/blog/')->name('admin.blog.')->group(function () {
    Route::get('index', [blogController::class, 'index'])->name('index');
    Route::post('store', [blogController::class, 'store'])->name('store');
    Route::get('edit/{id}', [blogController::class, 'edit']);
    Route::post('update/{id}', [blogController::class, 'update']);
    Route::get('delete/{id}', [blogController::class, 'destroy'])->name('delete');
});

// Floor  routes
Route::prefix('admin/floor/')->name('admin.floor.')->group(function () {
    Route::get('index', [floorController::class, 'index'])->name('index');
    Route::post('store', [floorController::class, 'store'])->name('store');
    Route::get('edit/{id}', [floorController::class, 'edit']);
    Route::post('update', [floorController::class, 'update'])->name('update');
    Route::get('delete/{id}', [floorController::class, 'destroy'])->name('delete');
});

// table  routes
Route::prefix('admin/table/')->name('admin.table.')->group(function () {
    Route::get('index', [tableController::class, 'index'])->name('index');
    Route::post('store', [tableController::class, 'store'])->name('store');
    Route::get('edit/{id}', [tableController::class, 'edit']);
    Route::post('update', [tableController::class, 'update'])->name('update');
    Route::get('delete/{id}', [tableController::class, 'destroy'])->name('delete');
});

// website setting route
Route::prefix('admin/website-setting/')->name('admin.website_setting.')->group(function () {
    Route::get('index', [Website_settingController::class, 'index'])->name('index');
    Route::post('update', [Website_settingController::class, 'update'])->name('update');
});

// reservation  routes
Route::prefix('admin/reservation/')->name('admin.reservation.')->group(function () {
    Route::get('index', [reservationController::class, 'index'])->name('index');
    Route::get('pending', [reservationController::class, 'pendingReservation'])->name('pending');
    Route::post('store', [reservationController::class, 'store'])->name('store');
    Route::get('edit/{id}', [reservationController::class, 'edit']);
    Route::post('update', [reservationController::class, 'update'])->name('update');
    Route::get('delete/{id}', [reservationController::class, 'destroy'])->name('delete');
});

// customer  routes
Route::prefix('admin/customer/')->name('admin.customer.')->group(function () {
    Route::get('index', [customerController::class, 'index'])->name('index');
    Route::post('store', [customerController::class, 'store'])->name('store');
    Route::get('edit/{id}', [customerController::class, 'edit']);
    Route::post('update', [customerController::class, 'update'])->name('update');
    Route::get('deactive/{id}', [customerController::class, 'deactive'])->name('deactive');
    Route::get('active/{id}', [customerController::class, 'active'])->name('active');
});

// Food  routes
Route::prefix('admin/food/')->middleware('admin')->name('admin.food.')->group(function () {
    Route::get('index', [FoodController::class, 'index'])->name('index');
    Route::post('store', [FoodController::class, 'store'])->name('store');
    Route::get('edit/{id}', [FoodController::class, 'edit']);
    Route::post('update', [FoodController::class, 'update'])->name('update');
    Route::get('delete/{id}', [FoodController::class, 'destroy'])->name('delete');
});

// customer comments route
Route::prefix('admin/customer-comment/')->middleware('admin')->name('admin.customer-comment.')->group(function () {
    Route::get('index', [CustomerCommentController::class, 'index'])->name('index');
    Route::get('edit/{id}', [CustomerCommentController::class, 'edit']);
    Route::post('update', [CustomerCommentController::class, 'update'])->name('update');
    Route::get('delete/{id}', [CustomerCommentController::class, 'destroy'])->name('delete');
});

// All HRM route 

//designation route
Route::prefix('admin/hrm/employee/designation/')->middleware('admin')->name('admin.hrm.employee.designation.')->group(function () {
    Route::get('index', [DesignationController::class, 'index'])->name('index');
    Route::post('store', [DesignationController::class, 'store'])->name('store');
    Route::get('edit/{designation}', [DesignationController::class, 'edit']);
    Route::post('update', [DesignationController::class, 'update'])->name('update');
    Route::get('delete/{designation}', [DesignationController::class, 'destroy'])->name('delete');
});

//department route
Route::prefix('admin/hrm/employee/department/')->middleware('admin')->name('admin.hrm.employee.department.')->group(function () {
    Route::get('index', [DepartmentController::class, 'index'])->name('index');
    Route::post('store', [DepartmentController::class, 'store'])->name('store');
    Route::get('edit/{department}', [DepartmentController::class, 'edit']);
    Route::post('update', [DepartmentController::class, 'update'])->name('update');
    Route::get('delete/{department}', [DepartmentController::class, 'destroy'])->name('delete');
});
//employee route
Route::prefix('admin/hrm/employee/employee/')->middleware('admin')->name('admin.hrm.employee.employee.')->group(function () {
    Route::get('index', [EmployeeController::class, 'index'])->name('index');
    Route::post('store', [EmployeeController::class, 'store'])->name('store');
    Route::get('edit/{employee}', [EmployeeController::class, 'edit']);
    Route::post('update', [EmployeeController::class, 'update'])->name('update');
    Route::get('delete/{employee}', [EmployeeController::class, 'destroy'])->name('delete');
});
//award route
Route::prefix('admin/hrm/employee/award/')->middleware('admin')->name('admin.hrm.employee.award.')->group(function () {
    Route::get('index', [AwardController::class, 'index'])->name('index');
    Route::post('store', [AwardController::class, 'store'])->name('store');
    Route::get('edit/{award}', [AwardController::class, 'edit']);
    Route::post('update', [AwardController::class, 'update'])->name('update');
    Route::get('delete/{award}', [AwardController::class, 'destroy'])->name('delete');
});
//attendance route
Route::prefix('admin/hrm/attendance/')->middleware('admin')->name('admin.hrm.attendance.')->group(function () {
    // single attendance
    Route::get('singleAttendance/index', [AttendanceController::class, 'index'])->name('singleAttendance');
    Route::get('create/person-wise-row/{user_id}', [AttendanceController::class, 'createRow']);
    Route::post('store', [AttendanceController::class, 'store'])->name('store.personWise');
    // all attendance
    Route::get('AllAttendance/index', [AttendanceController::class, 'AllAttendance'])->name('AllAttendance');
    Route::post('store/missing', [AttendanceController::class, 'missingStore'])->name('store.missing');
    Route::get('edit/{attendance}', [AttendanceController::class, 'edit']);
    Route::post('update', [AttendanceController::class, 'update'])->name('update');
    Route::get('delete/{attendance}', [AttendanceController::class, 'destroy'])->name('allAttendance.delete');
    // attendance adjustment
    Route::get('adjustment', [AttendanceController::class, 'adjustment'])->name('adjustment');
    Route::get('adjustment/form', [AttendanceController::class, 'adjustmentForm'])->name('adjustment.form');
    Route::get('adjustment/clock_in_change/{id}/{data}/{clock_in}', [AttendanceController::class, 'adjustmentClockInChange']);
    Route::get('adjustment/clock_out_change/{id}/{data}/{clock_out}', [AttendanceController::class, 'adjustmentClockOutChange']);



});

//holiday route
Route::prefix('admin/hrm/holiday')->middleware('admin')->name('admin.hrm.holiday.')->group(function () {
    Route::get('index', [HolidayController::class, 'index'])->name('index');
    Route::post('store/personWise', [HolidayController::class, 'store'])->name('store.personWise');
    Route::get('edit/{holiday}', [HolidayController::class, 'edit']);
    Route::post('update', [HolidayController::class, 'update'])->name('update');
    Route::get('delete/{holiday}', [HolidayController::class, 'destroy'])->name('delete');
});

//leaveType route
Route::prefix('admin/hrm/leaveType')->middleware('admin')->name('admin.hrm.leaveType.')->group(function () {
    Route::get('index', [LeavetypeController::class, 'index'])->name('index');
    Route::post('store', [LeavetypeController::class, 'store'])->name('store');
    Route::get('edit/{leaveType}', [LeavetypeController::class, 'edit']);
    Route::post('update', [LeavetypeController::class, 'update'])->name('update');
    Route::get('delete/{leaveType}', [LeavetypeController::class, 'destroy'])->name('delete');
});

//leave application route
Route::prefix('admin/hrm/leave')->middleware('admin')->name('admin.hrm.leave.')->group(function () {
    Route::get('index', [LeaveController::class, 'index'])->name('index');
    Route::post('store', [LeaveController::class, 'store'])->name('store');
    Route::get('edit/{leave}', [LeaveController::class, 'edit']);
    Route::post('update', [LeaveController::class, 'update'])->name('update');
    Route::get('delete/{leave}', [LeaveController::class, 'destroy'])->name('delete');
});

// expense type  routes
Route::prefix('admin/expensetype/')->middleware('admin')->name('admin.expensetype.')->group(function () {
    Route::get('index', [ExpensetypeController::class, 'index'])->name('index');
    Route::post('store', [ExpensetypeController::class, 'store'])->name('store');
    Route::get('edit/{id}', [ExpensetypeController::class, 'edit']);
    Route::post('update', [ExpensetypeController::class, 'update'])->name('update');
    Route::get('delete/{id}', [ExpensetypeController::class, 'destroy'])->name('delete');
});
// expense   routes
Route::prefix('admin/expense/')->middleware('admin')->name('admin.expense.')->group(function () {
    Route::get('index', [ExpenseController::class, 'index'])->name('index');
    Route::post('store', [ExpenseController::class, 'store'])->name('store');
    Route::get('edit/{expense}', [ExpenseController::class, 'edit']);
    Route::post('update', [ExpenseController::class, 'update'])->name('update');
    Route::get('delete/{expense}', [ExpenseController::class, 'destroy'])->name('delete');
});

require __DIR__ . '/auth.php';
