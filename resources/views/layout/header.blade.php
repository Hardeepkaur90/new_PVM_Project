<!-- @php
use App\Models\Admin;
use App\Models\Color;
use App\Models\Module;
use App\Models\Icon;
use App\Models\Setting;
@endphp
@php
$logo = Setting::join('colors', 'colors.id', '=', 'navbar_color')->first([
            'settings.id as id','colors.id as color_id','navbar_color','logo_image','site_name','contact_email','contact_phone','color_name','color_code',
        ]);
@endphp -->
<nav class="main-header navbar navbar-expand navbar-secondary text-white">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars text-white"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="" class="nav-link text-white">Dashboard</a>
        </li>
    </ul>
    <!-- Right navbar links -->
</nav>