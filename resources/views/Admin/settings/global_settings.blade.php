@extends('layout.app')
@section('globalsettings')
<div class="container-fluid p-1">
    <h3 class="ml-2 mt-1"><i class="bi bi-gear-wide mr-1"></i> Global Settings</h3>
    <div class="row">
        <div class="col-md-11 mx-auto">
            @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
            @endif
            <div class="card mt-1">
                <div class="active tab-pane" id="activity">
                    <div class="card-header bg-danger d-flex">
                        <i class="bi bi-gear-wide mr-1"></i>
                        <h3 class="card-title"> Global Settings </h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>header Color</th>
                                    <th>Site Name</th>
                                    <th>Logo Image</th>
                                    <th>Contact Email</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($setting as $settings)
                                <tr>
                                    <th>{{$loop->iteration}}</th>
                                    <td>{{$settings->color_name}}</td>
                                    <td>{{$settings->site_name}}</td>
                                    <td>
                                        <img src="{{asset('logo_img').'/'.$settings->logo_image}}" alt="" style="width:80px;height:80px;">
                                    </td>
                                    <td>{{$settings->contact_email}}</td>
                                    <td style="width:15%;">
                                        <a href="{{route('edit_settings',['id'=>$settings->id])}}" class="btn btn-warning ml-2" ><i class="bi bi-pencil-square"></i> Edit </a>
                                        <!-- <a href="" class="btn btn-danger ml-1" data-toggle="modal" data-target="#exampleModal"><i class="bi bi-trash"></i></a> -->
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-right">
                            <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
@endsection