@php
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
@endphp
<footer class="main-footer bg-{{$logo->color_name}}">
    <strong class=""><a href="" class="text-white">{{$logo->site_name}} </a></strong>
    <div class="float-right d-none d-sm-inline-block">
        <b>Contact Us At -:</b> {{$logo->contact_phone}}
    </div>
</footer>