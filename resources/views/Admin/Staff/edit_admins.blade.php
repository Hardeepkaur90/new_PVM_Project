@extends('layout.app')
@section('editadmin')
<div class="container-fluid rounded">
    <div class="row">
        <div class="col-md-5">
            <h2 class="mt-2 ml-2"> <i class="bi bi-clipboard-data mr-1"></i> Admin Management </h2>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-10 mx-auto rounded shadow-lg p-3 rounded">
            <div class="d-flex  justify-content-between">
                <span>
                    <h4> <i class="bi bi-file-earmark-plus"></i> Add Admins </h4>
                </span>
            </div>
            <div class="container mt-5">
                @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
                @endif
                <form class="form-horizontal" method="Post" action="{{url('edit/pages/post/'.$admin_edit->id)}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Name </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputName2" placeholder="Name" name="name" value="{{$admin_edit->name}}">
                            @error('name')
                            <p class="text-danger"> {{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Email </label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="inputName2" placeholder="Email" name="email" value="{{$admin_edit->email}}">
                            @error('email')
                            <p class="text-danger"> {{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Image</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" id="inputSkills" placeholder="Image" name="image">
                            <img src="{{asset('sub_admin_img').'/'.$admin_edit->image}}" alt="" style="height:120px; margin-top:10px;">
                            @error('image')
                            <p class="text-danger"> {{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Select Role</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="rolename">
                                <option value="0"> Not Selected </option>
                                @foreach($role_edit as $roles )
                                <option value="{{$roles->id}}">{{$roles->role_name}}</option>
                                @endforeach
                            </select>
                            @error('')
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
@endsection