@extends('layout.app')
@section('post')
<div class="container-fluid p-1">
    <h4 class="ml-3 mt-2"><i class="nav-icon fas fa-users mr-1  fa-lg"></i> Post Management </h4>

    <div class="row">
        <div class="col-md-11 mx-auto mt-2">
            <div class="bg-danger border p-2">
                <h6 class="ml-2 mt-1"><i class="bi bi-file-earmark-post-fill"></i> Add Post</h6>
            </div>
            <div class="bg-white shadow-lg p-4 border mb-2">
                <div class="row">
                    <div class="col-md-10 mx-auto">
                        @if (session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                        @endif
                        <form class="form-horizontal" method="post" enctype="multipart/form-data" action="{{route('save-post')}}">
                            @csrf
                            
                            <div class="form-group row">
                                <label for="inputExperience" class="col-sm-2 col-form-label">Post Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control"  placeholder="Enter Post Name" name="postname">
                                    @error('postname')
                                    <p class="text-danger"> {{$message}}</p>
                                    @enderror  
                                </div>
                                   
                            </div>
                                
                            <div class="form-group row">
                                <label for="inputSkills" class="col-sm-2 col-form-label">Post Description</label>
                                <div class="col-sm-10">
                                  <textarea class="ckeditor form-control" ype="text" name = 'postdesc'  rows="3"></textarea>
                                    @error('postdesc')
                                    <p class="text-danger"> {{$message}}</p>
                                    @enderror 
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputSkills" class="col-sm-2 col-form-label">Image for Post</label>
                                <div class="col-sm-10">
                                    <input type="file" onChange="changeimage(this)" class="form-control"  name="file">
                                    @error('file')
                                    <p class="text-danger alert alert-danger"> {{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div id="imgsection" class="form-group row" style="display:none">
                                <label for="inputSkills" class="col-sm-2 col-form-label">Your Selected Image:</label>
                                <div class="col-sm-10">
                                <img  id="blah" src="" height="50"width="50" >
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
    </div>
</div>
<script>
function changeimage(input){   
        if (input.files && input.files[0]) {
        var reader = new FileReader();
       reader.onload = function (e) {
      $('#blah')
        .attr('src', e.target.result)
        .width(150)
        .height(200);
    };
    $('#imgsection').css("display", "block")
    reader.readAsDataURL(input.files[0]);
  }
}
</script>

@endsection
