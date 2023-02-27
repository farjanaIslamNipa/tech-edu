<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="d-flex align-items-center pt-3">
        <span class="d-inline-block brand-text font-weight-bolder text-white pl-3" style="font-weight: 500!important; font-size:18px;">Geeks Learning</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div  class="info">
                <a href="#" class="d-block">
                    <i class="fas fa-user"></i>
                </a>

            </div>
            <div class="info">
                <a href="#" class="d-block">{{Auth::user()->first_name}} {{ Auth::user()->last_name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                @canany(['contact-list'])
                    <li class="nav-item">
                        <a href="{{ route('contacts.index') }}" class="nav-link">
                            <i class="fa-solid fa-comments" aria-hidden="true"></i>
                            <p>Client Contacts</p>
                        </a>
                    </li>
                @endcanany

                @canany(['package-subscription-list'])
                    <li class="nav-item">
                        <a href="{{ route('package-subscriptions.index') }}" class="nav-link">
                            <i class="fas fa-chart-pie" aria-hidden="true"></i>
                            <p>Package Subscriptions</p>
                        </a>
                    </li>
                @endcanany

                @canany(['role-list', 'role-create'])
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa-solid fa-user-lock"></i>
                        <p>Roles<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('role-list')
                            <li class="nav-item">
                                <a href="{{ route('roles.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>List</p>
                                </a>
                            </li>
                        @endcan
                        @can('role-create')
                            <li class="nav-item">
                                <a href="{{ route('roles.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create</p>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
                @endcanany
                @canany(['admin-list', 'admin-create'])
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa-solid fa-user"></i>
                        <p>Admins<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('admin-list')
                            <li class="nav-item">
                                <a href="{{ route('admins.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>List</p>
                                </a>
                            </li>
                        @endcan
                        @can('admin-create')
                            <li class="nav-item">
                                <a href="{{ route('admins.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create</p>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
                @endcanany
                @canany(['client-list', 'client-create'])
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa-solid fa-users" aria-hidden="true"></i>
                        <p>Clients<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('client-list')
                            <li class="nav-item">
                                <a href="{{ route('clients.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>List</p>
                                </a>
                            </li>
                        @endcan
                        @can('client-create')
                            <li class="nav-item">
                                <a href="{{ route('clients.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create</p>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
                @endcanany
                @canany(['course-category-list', 'course-module-list', 'course-module-create'])
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class=" fas fa-chart-pie"></i>
                        <p>Course Modules<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('course-category-list')
                            <li class="nav-item">
                                <a href="{{ route('course-categories.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Categories</p>
                                </a>
                            </li>
                        @endcan
                        @can('course-module-list')
                            <li class="nav-item">
                                <a href="{{ route('course-modules.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>List</p>
                                </a>
                            </li>
                        @endcan
                        @can('course-module-create')
                            <li class="nav-item">
                                <a href="{{ route('course-modules.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create</p>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
                @endcanany
                @canany(['package-list', 'package-create'])
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fa-solid fa-users" aria-hidden="true"></i>
                            <p>Packages<i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('package-list')
                                <li class="nav-item">
                                    <a href="{{ route('packages.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>List</p>
                                    </a>
                                </li>
                            @endcan
                            @can('package-create')
                                <li class="nav-item">
                                    <a href="{{ route('packages.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany
                @canany(['setting-edit'])
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fa fa-question-circle" aria-hidden="true"></i>
                            <p>Settings<i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('setting-edit')
                                <li class="nav-item">
                                    <a href="{{ route('settings.noticeEdit') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Notice Update</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany
                @canany(['frequently-asked-question-list', 'frequently-asked-question-create'])
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa fa-question-circle" aria-hidden="true"></i>
                        <p>FAQs<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('frequently-asked-question-list')
                            <li class="nav-item">
                                <a href="{{ route('frequently-asked-questions.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>List</p>
                                </a>
                            </li>
                        @endcan
                        @can('frequently-asked-question-create')
                            <li class="nav-item">
                                <a href="{{ route('frequently-asked-questions.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create</p>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
                @endcanany
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

