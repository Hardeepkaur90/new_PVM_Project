@extends('layout.app')
@section('editpages')
<div class="container-fluid rounded">
    <div class="row">
        <div class="col-md-5">
            <h2 class="mt-2 ml-2"> <i class="bi bi-clipboard-data mr-1"></i> Page Management </h2>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-10 mx-auto rounded shadow-lg p-3 rounded">
            <div class="d-flex  justify-content-between">
                <span>
                    <h4> <i class="bi bi-file-earmark-plus"></i> Edit Page </h4>
                </span>
            </div>
            <div class="container mt-5">
                @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
                @endif
                <form class="form-horizontal" method="post" action="{{url('edit/pages/post/'.$pageedit->id)}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Page Title </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputName2" placeholder="Page Title" name="pagetitle" value="{{$pageedit->title}}">

                            @error('pagetitle')
                            <p class="text-danger"> {{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Image</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" id="inputSkills" placeholder="Slug" name="image">
                            <img src="{{asset('Page_images').'/'.$pageedit->image}}" alt="" class="mt-2 ml-2" style="width:180px; height:200px;">

                            @error('image')
                            <p class="text-danger"> {{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Page Description</label>
                        <div class="col-sm-10">
                            <textarea id="summernote" name="pagedescription" rows="3">
                            {{$pageedit->description}}
                            </textarea>
                            @error('pagedescription')
                            <p class="text-danger"> {{$message}}</p>
                            @enderror
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
@endsection