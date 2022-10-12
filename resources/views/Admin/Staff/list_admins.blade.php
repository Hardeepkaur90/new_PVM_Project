@extends('layout.app')
@section('listadmins')
<div class="container-fluid rounded">
    <div class="d-flex  justify-content-between p-2">
        <div>
            <h2 class="mt-1 ml-2"> <i class="bi bi-person-bounding-box"></i> Staff Management </h2>
        </div>
        <div class="mt-1">
            <a href="{{route('add-admins')}}" class="btn btn-info"> Add Staff </a>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-11 mx-auto rounded shadow-lg p-3 rounded">
            <div class="d-flex  justify-content-between">
                <span>
                    <h4> <i class="bi bi-table ml-3 mt-5 mr-2"></i>Staff List </h4>
                </span>
            </div>
            <div class="container mt-2">
                <table class="table table-hover" id="page_table">
                    <thead>
                        <tr class="bg-white">
                            <th scope="col">S.No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Image</th>
                            <th scope="col">Role</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($admin as $admins)
                    <tr class="bg-white">
                            <th>{{$loop->iteration}}</th>
                            <td>{{$admins->name}}</td>
                            <td>{{$admins->email}}</td>
                            <td> <img src="{{asset('sub_admin_img').'/'.$admins->image}}" alt="" style="height:50px;"></td>
                            <td><button class="btn btn-primary btn-sm">{{$admins->role_name}}</button></td>
                            <td class="width:15%;">
                                <a href="{{url('edit-admins',['id'=>$admins->id])}}" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick=""><i class="bi bi-trash"></i></a>
                                <a href="{{url('view-staff',['id'=>$admins->id])}}" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
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