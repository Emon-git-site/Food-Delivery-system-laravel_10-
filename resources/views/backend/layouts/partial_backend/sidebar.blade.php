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

                
                <li class="nav-item {{ in_array(Route::currentRouteName(), ['admin.expensetype.index', 'admin.expense.index']) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Expense
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
                            {{-- {{ route('admin.expense.index') }} --}}
                            <a href="" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Expense</p>
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
