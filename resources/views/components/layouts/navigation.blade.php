<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Mendu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-header">{{ __('MENU OPTIONS') }}</li>
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>{{ __('Dashboard') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.sectors.index') }}" class="nav-link {{ request()->routeIs('admin.sectors.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-sitemap"></i>
                        <p>{{ __('Sectors') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.neighborhood.index') }}" class="nav-link {{ request()->routeIs('admin.neighborhood.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-map-marked-alt"></i>
                        <p>{{ __('Neighborhood') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../cells.html" class="nav-link">
                        <i class="nav-icon fas fa-compress-arrows-alt"></i>
                        <p>{{ __('Cells') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../bible-school.html" class="nav-link">
                        <i class="nav-icon fas fa-school"></i>
                        <p>{{ __('Bible Schools') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-friends"></i>
                        <p>
                            {{ __('Members') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../members/create-member.html" class="nav-link">
                                <i class="fas fa-genderless nav-icon text-primary"></i>
                                <p>{{ __('Create new member') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../members/adonais.html" class="nav-link">
                                <i class="fas fa-genderless nav-icon text-primary"></i>
                                <p>{{ __('Adonais') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../members/beraca.html" class="nav-link">
                                <i class="fas fa-genderless nav-icon text-primary"></i>
                                <p>{{ __('Beraca') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../members/kyrios.html" class="nav-link">
                                <i class="fas fa-genderless nav-icon text-primary"></i>
                                <p>{{ __('Kyrios') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../members/jehova-nissi.html" class="nav-link">
                                <i class="fas fa-genderless nav-icon text-primary"></i>
                                <p>{{ __('Jehova Nissi') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../members/shalom.html" class="nav-link">
                                <i class="fas fa-genderless nav-icon text-primary"></i>
                                <p>{{ __('Shalom') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">{{ __('USER ACCOUNT') }}</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users-cog"></i>
                        <p>
                            {{ __('Users') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="permission.html" class="nav-link">
                                <i class="fas fa-genderless nav-icon text-primary"></i>
                                <p>{{ __('Permission') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="roles.html" class="nav-link">
                                <i class="fas fa-genderless nav-icon text-primary"></i>
                                <p>{{ __('Roles') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="users.html" class="nav-link">
                                <i class="fas fa-genderless nav-icon text-primary"></i>
                                <p>{{ __('Users') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); this.closest('form').submit();" class="nav-link">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>{{ __('Logout') }}</p>
                        </a>
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
