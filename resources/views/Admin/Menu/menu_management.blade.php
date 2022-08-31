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
        width: 18%;

    }


    label {
        margin-top: 16px;

    }

    .btn {
        /* margin-top: 11px; */
        height: 38px;
        width: 104px;
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
            <h3 class="mt-1 ml-2"> <i class="bi bi-clipboard-data mr-1"></i> Menu Management </h3>
        </div>
    </div>

    <form id="add-item" style="margin-left:20px;" class="p-2" method="post">
        <div class="d-flex">
            <div class="d-flex container-fluid">
                <input type="text" placeholder="Name" name="name" class="form-control">
                <select name="custom_menu_id" class="form-control ml-3">
                    <option value="0">Not Selected</option>
                    @foreach ($custom_menu as $menu)
                    <option value="{{$menu->id}}">{{$menu->menu_title}}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success"> Add </button>
        </div>
    </form>
    <hr>
    <div class="dd ml-1" id="nestable">
        <?php
        $html_menu = menuTree();
        echo (empty($html_menu)) ? '<ol class="dd-list"></ol>' : $html_menu;
        ?>
    </div>
    <hr>
    <!-- ----------------------------------------------update menu form----------------------------------------------->
    <div class="p-3">
        <form action="{{url('updateMenu')}}" method="post">
            @csrf
            <input type="hidden" id="nestable-output" name="menu">
            <button class="btn btn-success" type="submit" onclick="deletePage();" style="width:149px;height:50px;margin-left:20px;">Save</button>
        </form>
    </div>

    <script>
        function deletePage(){
            swal({
                text: "Updated Successfully",
            })
        }
    </script>
    @endsection