@extends('layout.app')
@section('globalsettings')
<div class="container-fluid p-1">
    <div class="d-flex  justify-content-between p-2">
        <div>
            <h2 class="mt-1 ml-2"> <i class="bi bi-gear-wide mr-1"></i> Global Settings </h2>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-11 mx-auto rounded shadow-lg p-3 rounded">
            <div class="d-flex  justify-content-between">
                <span>
                    <h4> <i class="bi bi-table ml-3 mt-5"></i> Global Settings  Table </h4>
                </span>
            </div>
            <div class="container mt-2">
            <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>header Color</th>
                                    <th>Site Name</th>
                                    <th>Logo Image</th>
                                    <th>Contact Email</th>
                                    <th>Copy Right Text </th>
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
                                    <td>{{$settings->copyright}}</td>
                                    <td style="width:15%;">
                                        <a href="{{route('edit_settings',['id'=>$settings->id])}}" class="btn btn-warning ml-2"><i class="bi bi-pencil-square"></i> Edit </a>
                                        <!-- <a href="" class="btn btn-danger ml-1" data-toggle="modal" data-target="#exampleModal"><i class="bi bi-trash"></i></a> -->
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
            </div>
        </div>
    </div>
</div>
</div>
</div>



   
@endsection