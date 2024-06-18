<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show" style="background-color: #3d007e; color: #ecf0f1; width: 250px; height: 100vh; position: fixed; top: 0; left: 0; transition: all 0.3s; z-index: 1000;">
    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#" style="color: #ecf0f1;">
            {{ trans('panel.site_title') }}
        </a>
    </div>
    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link" style="color: #ecf0f1; transition: background-color 0.3s;" onmouseover="this.style.backgroundColor='##2a0a4b'" onmouseout="this.style.backgroundColor=''">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt"></i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @can('user_management_access')
        <li class="c-sidebar-nav-dropdown {{ request()->is("admin/permissions*") ? "c-show" : "" }} {{ request()->is("admin/roles*") ? "c-show" : "" }} {{ request()->is("admin/users*") ? "c-show" : "" }}">
            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                </i>
                {{ trans('cruds.userManagement.title') }}
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                @can('permission_access')
                    <li class="c-sidebar-nav-item">
                        <a href="{{ route("admin.permissions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "c-active" : "" }}">
                            <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                            </i>
                            {{ trans('cruds.permission.title') }}
                        </a>
                    </li>
                @endcan
                @can('role_access')
                    <li class="c-sidebar-nav-item">
                        <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "c-active" : "" }}">
                            <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                            </i>
                            {{ trans('cruds.role.title') }}
                        </a>
                    </li>
                @endcan
                @can('user_access')
                    <li class="c-sidebar-nav-item">
                        <a href="{{ route("admin.users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "c-active" : "" }}">
                            <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                            </i>
                            {{ trans('cruds.user.title') }}
                        </a>
                    </li>
                @endcan
            </ul>
        </li>
    @endcan
        @can('data_perkuliahan_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/mahasiswas*") ? "c-show" : "" }} {{ request()->is("admin/fakultas*") ? "c-show" : "" }} {{ request()->is("admin/jurusans*") ? "c-show" : "" }} ">
                <a class="c-sidebar-nav-dropdown-toggle" href="#" style="color: #ecf0f1; transition: background-color 0.3s;" onmouseover="this.style.backgroundColor='##2a0a4b'" onmouseout="this.style.backgroundColor=''">
                    <i class="fa-fw fas fa-graduation-cap c-sidebar-nav-icon"></i>
                    {{ trans('cruds.kuliah.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('mahasiswa_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.mahasiswas.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/mahasiswas") || request()->is("admin/mahasiswas/*") ? "c-active" : "" }}" style="color: #ecf0f1; transition: background-color 0.3s;" onmouseover="this.style.backgroundColor='##2a0a4b'" onmouseout="this.style.backgroundColor=''">
                                <i class="fas fa-user-graduate c-sidebar-nav-icon"></i>
                                {{ trans('cruds.data_mahasiswa.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('fakultas_access')
                    <li class="c-sidebar-nav-item">
                        <a href="{{ route("admin.fakultas.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/fakultas") || request()->is("admin/fakultas/*") ? "c-active" : "" }}" style="color: #ecf0f1; transition: background-color 0.3s;" onmouseover="this.style.backgroundColor='##2a0a4b'" onmouseout="this.style.backgroundColor=''">
                            <i class="fas fa-address-book c-sidebar-nav-icon"></i>
                            {{ trans('cruds.fakultas.title') }}
                        </a>
                    </li>
                    @endcan
                    @can('jurusan_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.jurusans.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/jurusans") || request()->is("admin/jurusans/*") ? "c-active" : "" }}" style="color: #ecf0f1; transition: background-color 0.3s;" onmouseover="this.style.backgroundColor='##2a0a4b'" onmouseout="this.style.backgroundColor=''">
                                <i class="fas fa-book c-sidebar-nav-icon"></i>
                                {{ trans('cruds.jurusan.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
            @can('profile_password_edit')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}" href="{{ route('profile.password.edit') }}" style="color: #ecf0f1; transition: background-color 0.3s;" onmouseover="this.style.backgroundColor='##2a0a4b'" onmouseout="this.style.backgroundColor=''">
                        <i class="fa-fw fas fa-key c-sidebar-nav-icon"></i>
                        {{ trans('global.change_password') }}
                    </a>
                </li>
            @endcan
        @endif
        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();" style="color: #ecf0f1; transition: background-color 0.3s;" onmouseover="this.style.backgroundColor='##2a0a4b'" onmouseout="this.style.backgroundColor=''">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt"></i>
                {{ trans('global.logout') }}
            </a>
        </li>
    </ul>
</div>
