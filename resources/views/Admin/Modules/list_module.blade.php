@extends('layout.app')
@section('list_modules')
<div class="container-fluid p-1">
    <h4 class="ml-3 mt-2"><i class="nav-icon fas fa-users mr-1  fa-lg"></i> Module Management </h4>
    <div class="row">
        <div class="col-md-11 mx-auto">
            @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
            @endif
            <div class="card">
                <div class="active tab-pane" id="activity">
                    <!-- Post -->

                    <div class="card-header bg-danger d-flex">
                        <i class="nav-icon fas fa-users mr-1 fa-lg"></i>
                        <h3 class="card-title"> List Modules  </h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Title</th>
                                    <th>Parent Module</th>
                                    <th>Module Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

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
@endsection