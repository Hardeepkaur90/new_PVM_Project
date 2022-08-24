@extends('layout.app')
@section('changepassword')
<header class="bg-light">
    <a href="{{route('dashboard')}}">
        <h4 class="ml-3 mt-2"><i class="bi bi-file-lock2 mr-2 fa-lg"></i> Change Password </h4>
    </a>
</header>
<div class="row">
    <div class="col-md-11 mx-auto mt-2">
        <div class="bg-danger border p-2">
            <h6 class="ml-2 mt-1"><i class="bi bi-file-lock2 mr-2 fa-lg"></i> Change Password </h6>
        </div>
        <div class="bg-white shadow-lg p-4 border mb-2">
            <div class="row">
                <div class="col-md-10 mx-auto">
                    @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success')}}
                    </div>
                    @endif
                    @if (session()->has('danger'))
                    <div class="alert alert-danger">
                        {{ session()->get('danger')}}
                    </div>
                    @endif
                    <form class="form-horizontal" method="post" action="{{url('change/password')}}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label font-weight-bold"> Current Password</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" id="inputEmail3" placeholder="Current Password " name="currentpassword">
                                    @if ($errors->has('currentpassword'))
                                    <span class="text-danger">{{ $errors->first('currentpassword') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label font-weight-bold ">New Password</label>
                                <div class="col-sm-9">
                                    <input id="password" type="password" class="form-control" name="newpassword">
                                    @error('newpassword')
                                    <p class="text-danger"> {{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label font-weight-bold ">New Confirm Password</label>
                                <div class="col-sm-9">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                    @error('password_confirmation')
                                    <p class="text-danger"> {{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" name="submit" class="btn btn-danger">Submit</button>
                        </div>
                        <!-- /.card-footer -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection