@extends('layout.app')
@section('modules')
<div class="container-fluid p-1">
    <h4 class="ml-3 mt-2"><i class="nav-icon fas fa-users mr-1  fa-lg"></i> Module Management </h4>

    <div class="row">
        <div class="col-md-11 mx-auto mt-2">
            <div class="bg-danger border p-2">
                <h6 class="ml-2 mt-1"><i class="nav-icon fas fa-users mr-1  fa-lg"></i> Add Modules</h6>
            </div>
            <div class="bg-white shadow-lg p-4 border mb-2">
                <div class="row">
                    <div class="col-md-10 mx-auto">
                        @if (session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                        @endif
                        <form class="form-horizontal" method="post" action="{{route('add-modules')}}">
                            @csrf
                            <div class="form-group row">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Select Icon</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="selecticon">
                                        <option value="0"> Not Selected </option>
                                        @foreach($icons as $icon)
                                        <option value="{{$icon->id}}"> {{$icon->icon_name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('selecticon')
                                <p class="text-danger"> {{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="inputName2" class="col-sm-2 col-form-label">Select Parent Module</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="selectparent">
                                        <option value="0"> Not Selected </option>
                                    </select>
                                    @error('selectparent')
                                    <p class="text-danger"> {{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputExperience" class="col-sm-2 col-form-label">Module Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputName2" placeholder="Module Name" name="modulename">
                                    @error('modulename')
                                    <p class="text-danger"> {{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputSkills" class="col-sm-2 col-form-label">Module slug</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputSkills" placeholder="Slug" name="moduleslug">
                                    @error('moduleslug')
                                    <p class="text-danger"> {{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                                        </label>
                                    </div>
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