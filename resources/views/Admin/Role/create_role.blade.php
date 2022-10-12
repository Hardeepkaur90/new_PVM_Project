@extends('layout.app')
@section('createroles')
<div class="container-fluid rounded">
    <div class="row">
        <div class="col-md-5">
            <h2 class="mt-2 ml-2"> <i class="bi bi-person-bounding-box mr-2"></i> Role Management </h2>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-10 mx-auto rounded shadow-lg p-3 rounded">
            <div class="d-flex  justify-content-between">
                <span>
                    <h4> <i class="bi bi-file-earmark-plus"></i> Add Roles </h4>
                </span>
            </div>
            <div class="container mt-5">
                @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
                @endif
                <form class="form-horizontal" method="Post" action="{{route('create-roles-post')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Role Name </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputName2" placeholder="Role Name" name="rolename">
                            @error('rolename')
                            <p class="text-danger"> {{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Select Icon</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="selecticon">
                                        <option value="0"> Not Selected </option>
                                        @foreach($icons as $icon_s)
                                        <option value="{{$icon_s->id}}"> {{$icon_s->icon_name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('selecticon')
                                <p class="text-danger"> {{$message}}</p>
                                @enderror
                            </div>
                    <!-- <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Image</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" id="inputSkills" placeholder="Slug" name="image">
                            @error('image')
                            <p class="text-danger"> {{$message}}</p>
                            @enderror
                        </div>
                    </div> -->
                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn btn-danger">Add</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection