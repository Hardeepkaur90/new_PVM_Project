@extends('layout.app')
@section('viewstaff')
<div class="container-fluid rounded">
    <div class="row">
        <div class="col-md-5">
            <h2 class="mt-2 ml-2"> <i class="bi bi-clipboard-data mr-1"></i> Staff Management </h2>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-10 mx-auto rounded shadow-lg p-3 rounded">
            <div class="d-flex  justify-content-between">
                <span>
                    <h4> <i class="bi bi-file-earmark-plus"></i> Add Staff </h4>
                </span>
            </div>



            <div class="container-fluid">
                <div class="card-body">
                    <div class="card-body">
                        <h5><span class="mr-2" style="font-weight: 600;">Name :</span> {{$admin_data->name}} </h5>
                        <h5><span class="mr-2" style="font-weight: 600;">Email :</span>{{$admin_data->email}} </h5>
                        <h5><span class="mr-2" style="font-weight: 600;">Image :</span> <br><img src="{{asset('sub_admin_img').'/'.$admin_data->image}}" style="height:150px;"></h5>
                        <h5><span class="mr-2" style="font-weight: 600;">Role Type:</span>{{$admin_data->role_name}}</h5>
                    </div>

                </div>
            </div>





        </div>
    </div>

</div>
<script>
    function deletePage(id) {
        swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this page!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location.href = "{{ url('delete-post') }}/" + id;
                } else {
                    swal("Your page is safe!");
                }
            });
    }
</script>
@endsection