@extends('layout.app')
@section('editglobalsettings')
<div class="container-fluid p-1">
    <h4 class="ml-3 mt-2"><i class="bi bi-gear-wide mr-1"></i> Global Settings </h4>
    <div class="row">
        <div class="col-md-11 mx-auto mt-2">
            <div class="bg-danger border p-2">
                <h6 class="ml-2 mt-1"><i class="bi bi-gear-wide mr-1"></i> Global Settings</h6>
            </div>
            <div class="bg-white shadow-lg p-4 border mb-2">
                <div class="row">
                    <div class="col-md-10 mx-auto">
                        @if (session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                        @endif
                        <form class="form-horizontal" method="post" action="{{route('create_settings/post')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Select Theme Color </label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="themecolor">
                                        <option value="0"> Not Selected </option>
                                        @foreach($color as $colors)
                                        <option value="{{$colors->id}}">{{$colors->color_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('themecolor')
                                <p class="text-danger"> {{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="inputExperience" class="col-sm-2 col-form-label">Logo Image</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" id="inputName2" placeholder="Module Name" name="logoimage">
                                    @error('logoimage')
                                    <p class="text-danger"> {{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputSkills" class="col-sm-2 col-form-label">Site Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputSkills" placeholder="Site Name" name="sitename">
                                    @error('sitename')
                                    <p class="text-danger"> {{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputSkills" class="col-sm-2 col-form-label">Contact Email</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputSkills" placeholder="Contact Email" name="contactemail">
                                    @error('contactemail')
                                    <p class="text-danger"> {{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputSkills" class="col-sm-2 col-form-label">Contact Phone</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputSkills" placeholder="Contact Phone" name="contactphone">
                                    @error('contactphone')
                                    <p class="text-danger"> {{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputSkills" class="col-sm-2 col-form-label">Copy Right Text</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputSkills" placeholder="Contact Phone" name="copyrighttext">
                                    @error('copyrighttext')
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
    </div>
</div>

@endsection