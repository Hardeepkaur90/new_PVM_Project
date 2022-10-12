@extends('layout.app')
@section('menu')
<style>
.menu-section {
    margin-left: -301px;

}

.menu-form {
    margin-left: 385px;
    margin-top: 100px;
    min-height: 500px;
}

.create-button {
    margin-left: 129px;
    margin-top: 20px;
    width: 221px;
    height: 48px;

}

.form-control {
    height: 49px;
    border-radius: 10px;
}

label {
    font-size: 17px;
    color: #343a40 !important;
}

.form-error {

    border: 2px solid #e74c3c;
    animation: shake .1s linear;
    animation-iteration-count: 2;
}

.val-error {
    background-color: red;
    color: white;
    width: 24px;
    border-radius: 20px;
    text-align: center;
    font-weight: 600;

}

.val-wrapper {
    font-size: 13.4px;
    inline-size: 201px;
    text-align: center;
    /* background-color: #554545; */
    background-color: #b300002e;
    color: red;
    border-style: solid;
    border-width: 1px;
    display: block;
    padding: 6px;
    padding-bottom: 6px;
    font-weight: 600;
    padding-bottom: 10px;

}

.view-menu-list {
    width: 454px;
    margin-left: 50px;
    margin-top: 100px;
    min-height: 500px;
}

.lists {
    background-color: #989899a6;
    margin-bottom: 20px;
    height: 45px;
    min-width: 200px;
    padding: 10px;
    font-size: 16px;
    font-weight: 600px;
    border-radius: 10px;
    display: inline-block;
    margin-left: 60px;
}

.mainlist {
    background-color: black;
}

.nav-icon {
    margin-right: 8px;
}


a {
    color: grey;
}

.action {
    margin-left: 197px;
    position: absolute;
    margin-top: -22px;

}
</style>

@section('title','Create Menu')




<div>
    @if(Session::has('fail'))
    <div class="alert alert-danger" role="alert"
        style="width: 300px;margin-top: 72px;margin-left: 512px;text-align: center;margin-bottom: -75px;">
        {{(Session::get('fail'))}}
    </div>
    @endif

    @if(Session::has('success'))
    <div class="alert alert-success" role="alert"
        style="width: 300px;margin-top: 72px;margin-left: 512px;text-align: center;margin-bottom: -75px;"
        id="successmsg">
        {{(Session::get('success'))}}
    </div>
    @endif
</div>
<div class="row">
    <div class="col-sm-10 menu-section">
        <div class="card card-secondary menu-form">
            <div class="card-header bg-danger" style="height:50px;">
                @if(!empty($mval['id']))
                <h3 class="card-title">Update Menu</h3>
                @else
                <h3 class="card-title">Create Menu</h3>
                @endif
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            @if(!empty($mval['id']))
            <form action="{{url('updated')}}" method="POST">
                @csrf
                <input type="hidden" value="{{$mval['id']}}" name="id">

                @endif
                <form action="{{url('created')}}" method="POST">
                    @csrf
                    <div class="card-body" style="display: block;">
                        <div class="form-group">



                            <div class="form-group">
                                <label for="inputStatus"> Menu Title</label>
                                <input type="text" name="menu_title" @if(!empty($mval['id']))
                                    value="{{$mval['menu_title']}}" @endif
                                    class=" form-control {{($errors->first('menu_title') ? " form-error" : "")}} ">
                                <!-- <span style=" color:red">@error('menu_title'){{$message}} @enderror</span> -->

                                @if(!empty($error= $errors->first('menu_title')))
                                <p class="val-error" style="margin-left: 6px;margin-top: 13px;">
                                    @error('menu_title')! @enderror</p>

                                <div class="val-wrapper"
                                    style="margin-top: -47px;margin-left: 38px;margin-bottom: 40px;">
                                    @error('menu_title'){{$message}} @enderror</div>
                                @endif
                            </div>


                            <div class="form-group">


                                <div class="row">
                                    <div class="col-sm-6">

                                        <label for="inputStatus">Select menu title</label>

                                        <select id="inputStatus" class="form-control custom-select" name="p_menu">
                                            @if(empty($parent))

                                            <option selected="" disabled="">
                                                No Parent menu found</option>

                                            @else

                                            <option selected="" disabled="">
                                                {{$parent->menu_title}}
                                            </option>

                                            @endif

                                            @if(empty($mval['id']))
                                            <option selected="" disabled="">Select option</option>
                                            <option value="0">None</option>
                                            @foreach($key as $data)
                                            <option value="{{$data->id}}">
                                                {{$data->menu_title}}
                                            </option>

                                            @endforeach

                                            @endif

                                            @if(!empty($mval['id']))
                                            @foreach($allmenulist as $data)
                                            <option value="{{$data->id}}">
                                                {{$data->menu_title}}
                                            </option>

                                            @endforeach
                                            @endif
                                        </select>


                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="inputStatus">Icons</label>
                                            <select id="inputStatus"
                                                class="form-control custom-select  {{($errors->first('icons') ? " form-error" : "")}}"
                                                name="icons">
                                                @if(!empty($mval['id']))
                                                <option selected="" disabled="">{{$mval['icons']}}</option>
                                                @else
                                                <option selected="" disabled="">Select one</option>
                                                @endif

                                                @foreach($icon as $value)
                                                <option value="{{$value->id}}">{{$value->icon_name}}</option>
                                                @endforeach



                                            </select>
                                            <!-- <span style="color:red">@error('icons'){{$message}} @enderror</span> -->
                                            @if(!empty($error= $errors->first('icons')))
                                            <p class="val-error" style="margin-left: 10px;margin-top: 14px;">
                                                @error('icons')! @enderror</p>

                                            <div class="val-wrapper"
                                                style="margin-top: -47px;margin-left: 41px;margin-bottom: -11px;">
                                                @error('icons'){{$message}} @enderror</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="inputStatus">URL</label>
                                        <select id="inputStatus"
                                            class="form-control custom-select  {{($errors->first('url') ? " form-error" : "")}} "
                                            name="url">
                                            @if(!empty($mval['id']))

                                            <option value="{{$mval['url']}}">{{$mval['url']}}</option>
                                            @else
                                            <option selected="" disabled="">Select one</option>
                                            @endif
                                            <option value="menu-list">Menu List</option>
                                            <option value="faq-list">FAQ List</option>
                                            <option value="slider-list">Slider List</option>
                                        </select>
                                        <!-- <span style="color:red">@error('url'){{$message}} @enderror</span> -->
                                        @if(!empty($error= $errors->first('url')))
                                        <p class="val-error" style="margin-left: 6px;margin-top: 12px;">
                                            @error('url')! @enderror</p>

                                        <div class="val-wrapper"
                                            style="margin-top: -46px;margin-left: 36px;margin-bottom: 59px;">
                                            @error('url'){{$message}} @enderror</div>
                                        @endif
                                    </div>

                                </div>
                            </div>
                            @if(!empty($mval['id']))
                            <button type="submit" class="btn btn-danger create-button">Update</button>
                            @else
                            <button type="submit" class="btn btn-danger create-button">Create</button>
                            @endif
                        </div>
                </form>

                <!-- ------------------------------------------------------------------------------------------------------- -->

        </div>
    </div>

</div>


<div class="contain mb-5">
    <div class="card card-secondary view-menu-list">
        <div class="card-header bg-danger" style="height: 60px;">
            <h3 class="card-title p-2">Arrange menu title order</h3>
            <div class="card-tools">
            </div>
        </div>
        <div class="card-body">
            <?= $menus ?>
        </div>
    </div>

</div>


<script>
$("document").ready(function() {
    setTimeout(function() {
        $("#successmsg").fadeOut('slow');
    }, 1000);
});
</script>
</div>
@endsection