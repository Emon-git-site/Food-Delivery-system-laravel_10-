<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('backend') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('backend') }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::guard('admin')->user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item {{ in_array(Route::currentRouteName(), ['admin.dashboard']) ? 'menu-open' : '' }}">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->is('admin.dashboard') ? 'acitve' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                {{-- <li class="nav-item">
                    <a href="#" class="nav-link"> --}}
                        <li class="nav-item {{ in_array(Route::currentRouteName(), ['category.index', 'subcategory.index']) ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Category
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('category.index') }}" class="nav-link {{ Route::currentRouteName() == 'category.index' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Category</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('subcategory.index') }}" class="nav-link {{ Route::currentRouteName() == 'subcategory.index' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sub Category</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.beverage.index') }}" class="nav-link {{ Route::currentRouteName() == 'beverage.index' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Beverage</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item {{ in_array(Route::currentRouteName(), ['admin.blogCategory.index', 'admin.blog.index']) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Blog
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.blogCategory.index') }}" class="nav-link {{ Route::currentRouteName() == 'admin.blogCategory.index' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Blog Category</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.blog.index') }}" class="nav-link {{ Route::currentRouteName() == 'admin.blog.index' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Blog Post</p>
                            </a>
                        </li>
                    </ul>
                </li>
                </li>
                <li class="nav-item customer {{ in_array(Route::currentRouteName(), ['admin.reservation.index']) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Reservation
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.reservation.index') }}" class="nav-link {{ Route::currentRouteName() == 'admin.reservation.index' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage Reservation</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.reservation.pending') }}" class="nav-link {{ Route::currentRouteName() == 'admin.reservation.pending' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pending Request</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ in_array(Route::currentRouteName(), ['admin.food.index']) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Food
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.food.index') }}" class="nav-link {{ Route::currentRouteName() == 'admin.food.index' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage Food</p>
                            </a>
                        </li>
                    </ul>
                </li>          
                <li class="nav-item {{ in_array(Route::currentRouteName(), ['admin.floor.index', 'admin.customer.index', 'admin.table.index']) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Setup
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.floor.index') }}" class="nav-link {{ Route::currentRouteName() == 'admin.floor.index' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Floor Manage</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.customer.index') }}" class="nav-link {{ Route::currentRouteName() == 'admin.customer.index' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage Customer</p>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="{{ route('admin.table.index') }}" class="nav-link {{ Route::currentRouteName() == 'admin.table.index' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Table Manage</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ in_array(Route::currentRouteName(), ['admin.website_setting.index']) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Setting
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.website_setting.index') }}" class="nav-link {{ Route::currentRouteName() == 'admin.website_setting.index' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Website Setting</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">HRM</li>
                <li class="nav-item {{ in_array(Route::currentRouteName(), ['admin.hrm.employee.designation.index', 'admin.hrm.employee.department.index', 'admin.hrm.employee.employee.index']) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Employee
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.hrm.employee.designation.index') }}" class="nav-link {{ Route::currentRouteName() == 'admin.hrm.employee.designation.index' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage Designation</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.hrm.employee.department.index') }}" class="nav-link {{ Route::currentRouteName() == 'admin.hrm.employee.department.index' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage Department</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.hrm.employee.employee.index') }}" class="nav-link {{ Route::currentRouteName() == 'admin.hrm.employee.employee.index' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage Employee</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.hrm.employee.award.index') }}" class="nav-link {{ Route::currentRouteName() == 'admin.hrm.employee.award.index' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Emp. Award</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ in_array(Route::currentRouteName(), ['admin.hrm.holiday.index', 'admin.hrm.leaveType.index', 'admin.hrm.leave.index']) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Leave & Holiday
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.hrm.holiday.index') }}" class="nav-link {{ Route::currentRouteName() == 'admin.hrm.holiday.index' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Holiday</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.hrm.leaveType.index') }}" class="nav-link {{ Route::currentRouteName() == 'admin.hrm.leaveType.index' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>LeaveType</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.hrm.leave.index') }}" class="nav-link {{ Route::currentRouteName() == 'admin.hrm.leave.index' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Leave Application</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item {{ in_array(Route::currentRouteName(), ['admin.hrm.attendance.singleAttendance', 'admin.hrm.attendance.AllAttendance', 'admin.hrm.attendance.adjustment']) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Attendance
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.hrm.attendance.singleAttendance') }}" class="nav-link {{ Route::currentRouteName() == 'admin.hrm.attendance.singleAttendance' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Single Attendance</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.expense.index') }}" class="nav-link {{ Route::currentRouteName() == 'admin.expense.index' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Bulk Attendance </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.hrm.attendance.AllAttendance') }}" class="nav-link {{ Route::currentRouteName() == 'admin.hrm.attendance.AllAttendance' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>ALL Attendance </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.hrm.attendance.adjustment') }}" class="nav-link {{ Route::currentRouteName() == 'admin.hrm.attendance.adjustment' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Attendance Adjustment</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ in_array(Route::currentRouteName(), ['admin.expensetype.index', 'admin.expense.index']) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Loan & Advance
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.expensetype.index') }}" class="nav-link {{ Route::currentRouteName() == 'admin.expensetype.index' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Grant Loan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.expense.index') }}" class="nav-link {{ Route::currentRouteName() == 'admin.expense.index' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Grant Advance </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ in_array(Route::currentRouteName(), ['admin.expensetype.index', 'admin.expense.index']) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Payroll
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.expensetype.index') }}" class="nav-link {{ Route::currentRouteName() == 'admin.expensetype.index' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Salary Generate</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.expense.index') }}" class="nav-link {{ Route::currentRouteName() == 'admin.expense.index' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Salary Report </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ in_array(Route::currentRouteName(), ['admin.expensetype.index', 'admin.expense.index']) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Expenses
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.expensetype.index') }}" class="nav-link {{ Route::currentRouteName() == 'admin.expensetype.index' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Expense Type</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.expense.index') }}" class="nav-link {{ Route::currentRouteName() == 'admin.expense.index' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Expense </p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
