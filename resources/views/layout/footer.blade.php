
<!-- @php
use App\Models\Admin;
use App\Models\Color;
use App\Models\Module;
use App\Models\Icon;
use App\Models\Setting;
@endphp
@php
$logo = Setting::join('colors', 'colors.id', '=', 'theme_color')->first([
            'settings.id as id','colors.id as color_id','theme_color','logo_image','site_name','contact_email','contact_phone','color_name','color_code',
        ]);

<footer class="main-footer bg-secondary">

    <strong class=""><a href="" class="text-white"> </a></strong>

    <div class="float-right d-none d-sm-inline-block">
        <b>Contact Us At -:</b>
    </div>
</footer>