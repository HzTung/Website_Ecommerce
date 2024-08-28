<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <input id="user2" type="hidden" name="userId" value="{{ Auth::guard('admin')->user()->id }}">
    <!-- Brand Logo -->
    <div class="brand-link d-flex justify-content-between">
        <span class="brand-text font-weight-light ">{{ Auth::guard('admin')->user()->name }} |
            {{ Auth::guard('admin')->user()->position }} </span>
        <a class="btn btn-info" href="{{ route('admin.logout') }}">Logout</a>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
        with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="{{ route('admin.category.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Danh muc
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.products.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Sản phẩm
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.bills.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Đơn Hàng
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Comment
                        </p>
                    </a>
                </li>

                {{-- <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Thống kê
                        </p>
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a href="{{ route('admin.chat.private') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Chat
                        </p>
                    </a>
                </li>
                @if (Auth::guard('admin')->user()->position == 'admin')
                    <li class="nav-item">
                        <a href="{{ route('admin.user.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                nhan vien
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.role.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                role
                            </p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
