@extends('layout.app')
@section('menumanagement')
<link href="{{ asset('style/nestable/jquery.nestable.css') }}" rel="stylesheet">
<link href="{{ asset('style/nestable/nestableCustomStyle.css') }}" rel="stylesheet">
<script src="{{ asset('js/nestable/jquery.nestable.js')}}"></script>
<script src="{{ asset('js/nestable/nestableCustomScript.js')}}"></script>
<style>
hr {
    border-top: 1px solid #000;
}

select {
    padding: 5px;
    height: 35px;
    min-width: 206px;
}

.form-control {
    width: 33%;
    margin-left: 10px;
}


.addbtn {
    /* margin-top: 11px; */
    height: 38px;
    width: 104px;
    margin-left: 10px;
}

.savebtn {
    margin-left: 206px;
    width: 149px;
    height: 50px;
    margin-top: 27px;
}

.content-container {
    margin-left: 75px !important;
}

.add-form {
    display: flex;
    background-color: #a9a9a926;
    padding: 31px;
    max-width: 739px;
    margin-left: -43px;
}
</style>
<?php

use Illuminate\Support\Facades\DB;

function renderMenuItem($id, $label, $url, $custom_menu_id)
{
    $custom_menu = DB::table('menus')->orderBy('id', 'ASC')->get();
    $option = "";

    foreach ($custom_menu as $menu) {
        if ($custom_menu_id == $menu->id) {
            $option .= "<option value='" . $menu->id . "' selected>" . $menu->menu_title . "</option>";
        } else {
            $option .= '<option value="' . $menu->id . '">' . $menu->menu_title . '</option>';
        }
    }
    return '<li class="dd-item dd3-item" data-id="' . $id . '" data-label="' . $label . '" data-url="' . $custom_menu_id . '">' .
        '<div class="dd-handle dd3-handle" > Drag</div>' .
        '<div class="dd3-content"><span>' . $label . '</span>' .
        '<div class="item-edit"><i class="nav-icon fas fa-edit"></i></div>' .
        '</div>' .
        '<div class="item-settings d-none">' .
        '<p><label for="">Navigation Label<br><input type="text"  name="navigation_label" value="' . $label . '"></label></p>' .
        '<p><label for="">Navigation Url<br><select name="navigation_url"  > ' . $option . '</select></label></p>' .
        '<p><a class="item-delete" href="javascript:;">Remove</a> |' .
        '<a class="item-close" href="javascript:;">Close</a></p>' .
        '</div>';
}

function menuTree($parent_id = 0)
{

    $items = '';
    $query = DB::table('menus')->where('p_menu', $parent_id)->orderBy('id', 'ASC')->get();
    if ((count($query)) > 0) {
        $items .= '<ol class="dd-list">';
        foreach ($query as $row) {
            $items .= renderMenuItem($row->id, $row->menu_title, $row->icons, $row->url);
            $items .= menuTree($row->id);
            $items .= '</li>';
        }
        $items .= '</ol>';
    }
    return $items;
}
$custom_menu = DB::table('menus')->orderBy('id', 'ASC')->get();
?>

<!-- -----------------------------------------add menu---------------------------------------------------------->
<div class="container-fluid rounded">
    <div class="d-flex  justify-content-between p-2">
        <div>
            <h2 class="mt-1 ml-2"> <i class="bi bi-clipboard-data mr-1"></i> Menu Management </h2>
        </div>
        <div class="mt-1">
            <a href="add-slider" class="btn btn-info"> Add Slider Image </a>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-9 mx-auto rounded shadow-lg p-3 rounded content-container">
            <div class="d-flex  justify-content-between">
                <span>
                    <h4> <i class="bi bi-table ml-3 mt-5"></i> Menu List </h4>
                </span>
            </div>
            <div class="container mt-2" style="margin-left: 100px;">

                <form id="add-item" style="margin-top:50px;">
                    <div class="container add-form">
                        <label for="inputStatus" style="margin-top: 8px;margin-right: 10px;"> Menu Title </label>
                        <input type="text" class="form-control " name="name" placeholder="Enter menu title">
                        <!-- <input type="text" name="url" placeholder="Url"> -->
                        <select name="custom_menu_id" class="form-control custom-select">
                            @foreach ($custom_menu as $menu)
                            <option value="{{$menu->id}}">{{$menu->menu_title}}</option>
                            @endforeach
                        </select>
                        <button class="btn btn-outline-secondary addbtn" type="submit">Add Item</button>
                    </div>
                </form>

                <div class="dd" id="nestable">
                    <?php
                    $html_menu = menuTree();
                    echo (empty($html_menu)) ? '<ol class="dd-list"></ol>' : $html_menu;
                    ?>
                </div>

                <!-- ----------------------------------------------update menu form----------------------------------------------->

                <form action="{{url('updateMenu')}}" method="post">
                    @csrf
                    <input type="hidden" id="nestable-output" name="menu">
                    <button class="btn btn-outline-secondary savebtn" type="submit">Save Menu</button>
                </form>

            </div>
        </div>
    </div>
</div>

</div>

</div>
</div>
@endsection