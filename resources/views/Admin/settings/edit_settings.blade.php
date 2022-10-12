@extends('layout.app')
@section('editglobalsettings')
<div class="row">
    <div class="col-md-5">
        <h2 class="mt-2 ml-2"> <i class="bi bi-clipboard-data mr-1"></i> Global Settings </h2>
    </div>
</div>
<div class="row mt-4">
    <div class="col-md-10 mx-auto rounded shadow-lg p-3 rounded">
        <div class="d-flex  justify-content-between">
            <span>
                <h4> <i class="bi bi-file-earmark-plus"></i> Global Settings </h4>
            </span>
        </div>
        <div class="container mt-5">






            @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
            @endif

            <form class="form-horizontal" method="post" action="{{url('edit/post_settings').'/'.$data->settings_id}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Select Theme Color </label>
                    <div class="col-sm-10">
                        <select class="form-control" name="themecolor">
                            <option value="0"> {{$data->color_name}}</option>
                            @foreach($color as $colors)
                            <option value="{{$colors->id}}">{{$colors->color_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('themecolor')
                    <p class="text-danger"> {{$message}} </p>
                    @enderror
                </div>
                <div class="form-group row">
                    <label for="inputExperience" class="col-sm-2 col-form-label">Logo Image</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" id="inputName2" placeholder="Module Name" name="logoimage">
                        <img src="{{asset('logo_img').'/'.$data->logo_image}}" alt="" class="mt-2 ml-2" style="width:180px; height:200px;">
                        @error('logoimage')
                        <p class="text-danger"> {{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputSkills" class="col-sm-2 col-form-label">Site Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputSkills" placeholder="Site Name" name="sitename" value="{{$data->site_name}}">
                        @error('sitename')
                        <p class="text-danger"> {{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputSkills" class="col-sm-2 col-form-label">Contact Email</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputSkills" placeholder="Contact Email" name="contactemail" value="{{$data->contact_email}}">
                        @error('contactemail')
                        <p class="text-danger"> {{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputSkills" class="col-sm-2 col-form-label">Contact Phone</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputSkills" placeholder="Contact Phone" name="contactphone" value="{{$data->contact_phone}}">
                        @error('contactphone')
                        <p class="text-danger"> {{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputSkills" class="col-sm-2 col-form-label">Copy Right Text</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputSkills" placeholder="Contact Phone" name="copyrighttext"value="{{$data->copyright}}">
                        @error('copyrighttext')
                        <p class="text-danger"> {{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn btn-danger">Edit</button>
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
@endsection