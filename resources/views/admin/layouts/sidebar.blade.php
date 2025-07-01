<div class="left-side-bar">
    <div class="brand-logo">
        <a href="{{ route('admin.dashboard') }}">
            <img src="{{ asset('assets/vendors/images/deskapp-logo-white.svg') }}" alt="" class="light-logo">
        </a>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">
                <li class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}" class="dropdown-toggle no-arrow sidebar-item" data-section="Dashboard">
                        <span class="micon dw dw-house-1"></span>
                        <span class="mtext">Dashboard</span>
                    </a>
                </li>

                <li class="{{ request()->is('admin/users*') ? 'active' : '' }}">
                    <a href="{{ route('admin.usersList') }}" class="dropdown-toggle no-arrow sidebar-item" data-section=
                        "@if(request()->routeIs('admin.usersList'))Users
                        @elseif(request()->routeIs('admin.userDetails'))User Details
                        @elseif(request()->routeIs('admin.userEdit'))Edit User
                        @elseUsers
                        @endif"
                    >
                        <span class="micon dw dw-house-1"></span>
                        <span class="mtext">Users</span>
                    </a>
                </li>

                {{-- <li class="dropdown {{ request()->is('admin/users/*') ? 'show' : '' }}">
                    <a href="javascript:;" class="dropdown-toggle" data-section="Users">
                        <span class="micon dw dw-edit2"></span>
                        <span class="mtext">Users</span>
                    </a>
                    <ul class="submenu {{ request()->is('forms/*') ? 'show' : '' }}">
                        <li><a href="{{ route('forms.basic') }}" class="sidebar-item" data-section="Basic Form">Form Basic</a></li>
                        <li><a href="{{ route('forms.advanced') }}" class="sidebar-item" data-section="Advanced Forms">Advanced Components</a></li>
                    </ul>
                    <ul class="submenu {{ request()->is('admin/users/*') ? 'show' : '' }}">
                        <li><a href="javascript:;" class="sidebar-item" data-section="Users Favorite Countries">Users Favorite Countries</a></li>
                        <li><a href="javascript:;" class="sidebar-item" data-section="Users KYC Information">Users KYC Information</a></li>
                        <li><a href="javascript:;" class="sidebar-item" data-section="Users Orders">Users Orders</a></li>
                    </ul>
                </li> --}}

                <li class="{{ request()->is('admin/countries') ? 'active' : '' }}">
                    <a href="{{ route('admin.countriesList') }}" class="dropdown-toggle no-arrow sidebar-item" data-section="Countries">
                        <span class="micon dw dw-house-1"></span>
                        <span class="mtext">Countries</span>
                    </a>
                </li>

                <li class="{{ request()->is('admin/packages') ? 'active' : '' }}">
                    <a href="javascript:;" class="dropdown-toggle no-arrow sidebar-item" data-section="Packages">
                        <span class="micon dw dw-house-1"></span>
                        <span class="mtext">Packages</span>
                    </a>
                </li>

                <li class="{{ request()->is('admin/admins') ? 'active' : '' }}">
                    <a href="{{ route('admin.adminsList') }}" class="dropdown-toggle no-arrow sidebar-item" data-section="Admins">
                        <span class="micon dw dw-house-1"></span>
                        <span class="mtext">Admins</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
