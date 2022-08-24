@extends('layout.app')
@section('addicons')
<div class="container-fluid p-5">
        <div class="row">
            <div class="col-md-11 mt-1 mx-auto">
            @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
            @endif
                <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Add Icons </h3>
              </div>
              <form class="form-horizontal" method="post" action="{{route('add_icons')}}">
                @csrf
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Icon Name </label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputEmail3" placeholder="Icon Name" name="icon_name">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Icon image</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputPassword3" placeholder="Icon Image" name="icon_image">
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-danger">Submit</button>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
            </div>
        </div>
    </div>
@endsection