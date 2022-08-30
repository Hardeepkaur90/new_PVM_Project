@php
use App\Models\Admin;
use App\Models\Color;
use App\Models\Module;
use App\Models\Icon;
use App\Models\Setting;
@endphp




<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
        @php
        $logo = Setting::first();
        @endphp
        <img src="{{asset('logo_img/'.$logo->logo_image)}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity:.8;">
        <div><h5 class="brand-text font-weight-bold">{{$logo->site_name}}</h5></div>
        
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">

                <!-- <img src="" class="img-circle elevation-2" alt="User Image"> -->
            </div>
            <div class="info">
                <a href="#" class="d-block"></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{url('dashboard')}}" class="nav-link">
                       <i class="nav-icon fas fa-home"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Users
                        </p>
                    </a>
                </li>
                <li class="nav-item ml-2">
                    <a href="#" class="nav-link text-white">
                        <i class="bi bi-newspaper mr-1"></i>
                        <p>
                            Create Module
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('list-modules')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Module List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('modules')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Module</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <div class="mt-2">
                    <h6 class="text-white"> Menu's</h6>
                </div>
                <li class="nav-item">
                    <a href="" class="nav-link text-white">
                        <i class="bi bi-menu-button-wide" style="margin-right:10px;"></i>
                        <p>
                            Menu Management
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ml-3">
                            <a href="<?= url('menu'); ?>" class="nav-link">
                            <i class="bi bi-menu-button-wide mr-1"></i>
                                <p>Menu</p>
                            </a>
                        </li>
                    </ul>
                <li class="nav-item">
                    <a href="{{route('list/pages')}}" class="nav-link text-white">
                        <i class="bi bi-clipboard-data" style="margin-right:10px;"></i>
                        <p>
                            Page Management
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item ml-3">
                            <a href="" class="nav-link">
                            <i class="bi bi-clipboard-data mr-1"></i>
                                <p>Pages</p>
                            </a>
                        </li>
                    </ul>
                 </li>
                 <li class="nav-item">
                    <a href="{{ url('all-posts') }}" class="nav-link text-white">
                    <i class="bi bi-file-earmark-post-fill"style="margin-right:10px;"></i>
                    
                        <p>
                           Post Management
                        </p>
                    </a>
                   
                 </li>

                <div class="mt-2">
                    <h6 class="text-white"> Settings </h6>
                </div>
                <li class="nav-item">
                    <a href="" class="nav-link text-white">
                        <i class="bi bi-gear" style="margin-right:10px;"></i>
                        <p>
                            Settings
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ml-3">
                            <a href="{{route('global_settings')}}" class="nav-link">
                                <i class="bi bi-gear-wide mr-1"></i>
                                <p>Global Settings</p>
                            </a>
                        </li>
                        <li class="nav-item ml-3">
                            <a href="{{route('change')}}" class="nav-link">
                                <i class="bi bi-person-circle mr-1"></i>
                                <p> Change Password </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <a href="{{route('logout')}}" class="nav-link text-white">
                    <i class="bi bi-power mr-1 p-1"></i>
                    <p>
                        Logout
                    </p>
                </a>
        </nav>
    </div>
</aside>