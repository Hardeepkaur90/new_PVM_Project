@extends('layout.app')
@section('addslider')
<style>
    .form-error {

        border: 2px solid #e74c3c;
        animation: shake .1s linear;
        animation-iteration-count: 2;
    }

    .add-btn {
        margin-left: 500px;
        margin-top: 20px;
        width: 221px;
        height: 48px;

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

    /* .form-control {
    height: 49px;
    border-radius: 10px;
} */

    .alert {
        width: 414px;
        margin-top: 5px;
        margin-left: 512px;
        text-align: center;
        margin-bottom: -36px;
        padding: 21px;
        /* animation: shake .2s linear;
    animation-iteration-count: 2; */
    }
</style>


@section('title','Add Slider')



<div>
    @if(Session::has('fail'))
    <div class="alert alert-danger" role="alert">
        {{(Session::get('fail'))}}
    </div>
    @endif

    @if(Session::has('success'))
    <div class="alert alert-success" role="alert" id="successmsg">
        {{(Session::get('success'))}}
    </div>
    @endif
</div>
<div class="container-fluid rounded">
    <div class="row">
        <div class="col-md-5">
            <h2 class="mt-2 ml-2"> <i class="bi bi-menu-button-wide" style="margin-right:10px;"></i> Slider Management </h2>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-10 mx-auto rounded shadow-lg p-3 rounded">
            <div class="d-flex  justify-content-between">
                <span>
                    <h4> <i class="bi bi-file-earmark-plus"></i> Add Images </h4>
                </span>
            </div>
            <div class="container mt-5">
                <!-- @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
                @endif -->
                <form class="form-horizontal" method="Post" action="{{url('added')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Image Title </label>
                        <div class="col-sm-10">
                            <input type="text" name="image_title" id="inputName" class="form-control{{($errors->first('image_title') ? " form-error" : "")}}"">
      
                           @if(!empty($error = $errors->first('image_title')))
                                   <p class=" val-error" style="margin-left: 6px;margin-top: 16px;margin-bottom: 31px;">

                            @error('image_title')! @enderror</p>

                            <div class="val-wrapper" style="margin-top: -64px;margin-left: 40px;margin-bottom: 22px;">
                                @error('image_title'){{$message}} @enderror</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Image</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control {{($errors->first('image') ? " form-error" : "")}}" id="inputSkills" placeholder="Slug" name="image">
                            @if(!empty($error= $errors->first('image')))
                            <p class="val-error" style="margin-left: 6px; margin-top: 11px;margin-bottom: 31px;">
                                @error('image')! @enderror</p>

                            <div class="val-wrapper" style="margin-top: -60px;margin-left: 40px; margin-bottom: 22px;">
                                @error('image'){{$message}} @enderror</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Image Description</label>
                        <div class="col-sm-10">
                            <textarea id="summernote" name="description" class="form-control {{($errors->first('description') ? " form-error" : "")}}"" rows=" 4">
                            </textarea>
                            @if(!empty($error = $errors->first('description')))
                            <p class="val-error" style="     margin-left: 6px;margin-top: 6px; margin-bottom: 31px;">
                                @error('description')! @enderror</p>

                            <div class="val-wrapper" style="margin-top: -62px; margin-left: 40px; margin-bottom: 22px;">
                                @error('description'){{$message}} @enderror</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        // Summernote
        var t = $('#summernote').summernote({
            height: 250,
            focus: true
        });

        // CodeMirror
        CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
            mode: "htmlmixed",
            theme: "monokai"
        });
    })
</script>
</script>

@endsection