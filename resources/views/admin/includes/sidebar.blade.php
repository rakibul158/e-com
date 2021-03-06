<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('images/admin/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ url('images/admin/admin_upload_profile_images/'.Auth::guard('admin')->user()->image) }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ ucwords(Auth::guard('admin')->user()->name) }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                   <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    @if(Session::get('page') == 'dashboard')
                        <?php $active = 'active'; ?>
                    @else
                        <?php $active = ''; ?>
                    @endif
                    <a href="{{ route('dashboard') }}" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <!-- Settings -->

                @if(Session::get('page')== 'settings' || Session::get('page') == 'update-admin-details')
                    <?php $active = 'active'; ?>
                @else
                    <?php $active = ''; ?>
                @endif
                <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>
                            Settings
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            @if(Session::get('page')== 'settings')
                                <?php $active = 'active'; ?>
                            @else
                                <?php $active = ''; ?>
                            @endif
                            <a href="{{ route('admin.settings') }}" class="nav-link {{ $active}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Change Password</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            @if(Session::get('page') == 'update-admin-details')
                                <?php $active = 'active'; ?>
                            @else
                                <?php $active = ''; ?>
                            @endif
                            <a href="{{route('admin.updateDetails')}}" class="nav-link {{ $active }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Update Info</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!--  Catalogue  -->
                @if(Session::get('page')== 'sections' || Session::get('page') == 'categories')
                    <?php $active = 'active'; ?>
                @else
                    <?php $active = ''; ?>
                @endif
                <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Catalogue
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            @if(Session::get('page')== 'sections')
                                <?php $active = 'active'; ?>
                            @else
                                <?php $active = ''; ?>
                            @endif
                            <a href="{{ route('sections.index') }}" class="nav-link {{ $active}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sections</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            @if(Session::get('page') == 'categories')
                                <?php $active = 'active'; ?>
                            @else
                                <?php $active = ''; ?>
                            @endif
                            <a href="{{ route('category.index') }}" class="nav-link {{ $active }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Categories</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            @if(Session::get('page') == 'products')
                                <?php $active = 'active'; ?>
                            @else
                                <?php $active = ''; ?>
                            @endif
                            <a href="{{ route('product') }}" class="nav-link {{ $active }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Products</p>
                            </a>
                        </li>
                    </ul>
                </li>


{{--                <li class="nav-header">MISCELLANEOUS</li>--}}
{{--                <li class="nav-item">--}}
{{--                    <a href="iframe.html" class="nav-link">--}}
{{--                        <i class="nav-icon fas fa-ellipsis-h"></i>--}}
{{--                        <p>Tabbed IFrame Plugin</p>--}}
{{--                    </a>--}}
{{--                </li>--}}


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
