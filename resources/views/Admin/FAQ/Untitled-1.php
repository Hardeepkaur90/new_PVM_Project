<!-- @php
use App\Models\Admin;
use App\Models\Color;
use App\Models\Module;
use App\Models\Icon;
use App\Models\Setting;
@endphp
@php
$logo = Setting::join('colors', 'colors.id', '=', 'navbar_color')->first([
'settings.id as id','colors.id as
color_id','navbar_color','logo_image','site_name','contact_email','contact_phone','color_name','color_code',
]);
@endphp -->