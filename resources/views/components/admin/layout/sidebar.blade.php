<?php
 $settings = getSettings();
?>

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('admin.dashboard')}}">
        <div class="sidebar-brand-icon ">
            @if(isset($settings['site_logo']) && !empty($settings['site_logo']))
                <img src="/{{$settings['site_logo']}}" alt="{{$settings['site_title']}}" />
            @else
                <i class="fas fa-laugh-wink"></i>
            @endif
        </div>
    </a>


    <!-- Nav Item - Dashboard -->
    @can('dashboard')
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.dashboard')}}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>{{__('Dashboard')}}</span></a>
        </li>
    @endcan


    <!-- Nav Item - Pages Collapse Menu -->
    @canany(['add user', 'view user', 'delete user', 'edit user','add role', 'view role', 'delete role', 'edit role'])
        <li class="nav-item parent">
            <a class="nav-link  {{ (request()->is('admin/users*') || request()->is('admin/roles*')) ? 'active' : 'collapsed' }} " href="#" data-bs-toggle="collapse" data-bs-target="#collapseusermanagement"
                aria-expanded="true" aria-controls="collapseusermanagement">
                <i class="fas fa-user"></i>
                <span>{{__('User Management') }}</span>
            </a>
            <div id="collapseusermanagement" class="collapse {{ (request()->is('admin/users*') || request()->is('admin/roles*')) ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="py-2 collapse-inner">
                    {{-- <h6 class="collapse-header">Custom Components:</h6> --}}
                    @canany(['add user', 'view user', 'delete user', 'edit user'])
                        <a class="collapse-item {{ request()->is('admin/users*') ? 'active' : '' }}" href="{{route('admin.users.index')}}" >{{__('Users')}}</a>
                    @endcanany
                    @canany(['add role', 'view role', 'delete role', 'edit role'])
                        <a class="collapse-item {{ request()->is('admin/roles*') ? 'active' : '' }}" href="{{route('admin.roles.index')}}" >{{__('Roles & Permissions')}}</a>
                    @endcanany
                    {{-- <a class="collapse-item" href="cards.html">Roles</a> --}}
                </div>
            </div>
        </li>
    @endcanany

    <!-- Nav Item - Utilities Collapse Menu -->
    @canany(['add product', 'view product', 'delete product', 'edit product','add category', 'view category', 'delete category', 'edit category'])

        <li class="nav-item parent">
            <a class="nav-link {{ request()->is('admin/product*') ? 'active' : 'collapsed' }}" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProductmanagement"
                aria-expanded="true" aria-controls="collapseProductmanagement">
                <i class="fas fa-fw fa-list"></i>
                <span>{{__('Product Management')}}</span>
            </a>
            <div id="collapseProductmanagement" class="collapse {{ request()->is('admin/product*') ? 'show' : '' }}" aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar">
                <div class="py-2 collapse-inner">
                    @canany(['add product', 'view product', 'delete product', 'edit product'])
                        <a class="collapse-item {{ request()->is('admin/products*') ? 'active' : '' }}" href="{{route('admin.products.index')}}" >{{__('Products')}}</a>
                    @endcanany
                    @canany(['add category', 'view category', 'delete category', 'edit category'])
                        <a class="collapse-item {{ request()->is('admin/product/categories*') ? 'active' : '' }}" href="{{route('admin.categories.index')}}">{{__('Categories')}}</a>
                    @endcanany
                </div>
            </div>
        </li>
    @endcanany

    <!-- Nav Item - Pages Collapse Menu -->

    <!-- Nav Item - Charts -->
    @canany(['add setting', 'view setting', 'delete setting', 'edit setting'])
        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/settings*') ? 'active' : '' }}" href="{{route('admin.settings.index')}}">
                <i class="fas fa-fw fa-wrench"></i>
                <span>{{__('Settings')}}</span></a>
        </li>
    @endcanany


    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
