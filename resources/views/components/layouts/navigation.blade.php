<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 text-center d-flex justify-content-center">
            <div class="info">
                <form method="POST" action="{{ route('logout') }}" class="form-inline">
                    @csrf
                    <a href="#">{{ Auth::user()->name }} | </a>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"
                        class="ml-1 d-block">
                        {{ __('Logout') }}
                        <i class="fas fa-power-off text-danger" title="{{ __('Logout') }}"></i>
                    </a>
                </form>
            </div>
        </div>

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
                    <a href="{{ route('admin.sectors.index') }}"
                        class="nav-link {{ request()->routeIs('admin.sectors.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-sitemap"></i>
                        <p>{{ __('Sectors') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.neighborhood.index') }}"
                        class="nav-link {{ request()->routeIs('admin.neighborhood.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-map-marked-alt"></i>
                        <p>{{ __('Neighborhood') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.cells.index') }}"
                        class="nav-link {{ request()->routeIs('admin.cells.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-compress-arrows-alt"></i>
                        <p>{{ __('Cells') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.bible-school.index') }}"
                        class="nav-link {{ request()->routeIs('admin.bible-school.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-school"></i>
                        <p>{{ __('Bible Schools') }}</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('admin.members.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('admin.members.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-friends"></i>
                        <p>
                            {{ __('Members') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.members.index') }}"
                                class="nav-link {{ request()->routeIs('admin.members.index') ? 'active' : '' }}">
                                <i class="fas fa-genderless nav-icon text-primary"></i>
                                <p>{{ __('Members') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.members.index-adonais') }}"
                                class="nav-link {{ request()->routeIs('admin.members.index-adonais') ? 'active' : '' }}">
                                <i class="fas fa-genderless nav-icon text-primary"></i>
                                <p>{{ __('Adonais') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.members.index-beraca') }}"
                                class="nav-link {{ request()->routeIs('admin.members.index-beraca') ? 'active' : '' }}">
                                <i class="fas fa-genderless nav-icon text-primary"></i>
                                <p>{{ __('Beraca') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.members.index-jehova-nissi') }}"
                                class="nav-link {{ request()->routeIs('admin.members.index-jehova-nissi') ? 'active' : '' }}">
                                <i class="fas fa-genderless nav-icon text-primary"></i>
                                <p>{{ __('Jehova Nissi') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.members.index-kyrios') }}"
                                class="nav-link {{ request()->routeIs('admin.members.index-kyrios') ? 'active' : '' }}">
                                <i class="fas fa-genderless nav-icon text-primary"></i>
                                <p>{{ __('Kyrios') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.members.index-shalom') }}"
                                class="nav-link {{ request()->routeIs('admin.members.index-shalom') ? 'active' : '' }}">
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
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
