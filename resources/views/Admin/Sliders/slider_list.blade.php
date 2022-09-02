@extends('layout.app')
@section('slider_list')
<link href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<style>
    .alert {
        width: 414px;
        margin-top: 5px;
        margin-left: 512px;
        text-align: center;
        margin-bottom: -36px;
        padding: 21px;
        /* animation: shake .2s linear;
    animation-iteration-count: 2; */
    }
</style>
@section('title','View Slider images')


<div>
    @if(Session::has('fail'))
    <div class="alert alert-danger" role="alert">
        {{(Session::get('fail'))}}
    </div>
    @endif

    @if(Session::has('success'))
    <div class="alert alert-success" role="alert" id="successmsg">
        {{(Session::get('success'))}}
    </div>
    @endif
</div>

<div class="container-fluid rounded">
    <div class="d-flex  justify-content-between p-2">
        <div>
            <h2 class="mt-1 ml-2"> <i class="bi bi-clipboard-data mr-1"></i> Slider Management </h2>
        </div>
        <div class="mt-1">
            <a href="add-slider" class="btn btn-info"> Add Slider Image </a>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-11 mx-auto rounded shadow-lg p-3 rounded">
            <div class="d-flex  justify-content-between">
                <span>
                    <h4> <i class="bi bi-table ml-3 mt-5"></i> Slider Image List </h4>
                </span>
            </div>
            <div class="container mt-2">
                <table class="table table-hover" id="slider_table">
                    <thead>
                        <tr class="bg-white">
                            <th>S.no</th>
                            <th>Image Title</th>
                            <th>Image Description</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sliderimg as $data)
                        <tr class="bg-white">
                            <td> {{ $loop->iteration }}</td>
                            <td>{{$data->image_title}}</td>
                            <td>{!! $data->description!!}</td>
                            <td style="text-align: center;"><img src="{{asset('images/slider/'.$data->image)}}" alt="image" style="height:50px;"></td>
                            <td style="text-align: center;">

                                <a href="{{"slider/edit/" .$data->id}}" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="deleteimg({{$data->id}})"><i class="bi bi-trash"></i></a>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert@2.1.2/dist/sweetalert.min.js"></script>
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
    $("table tbody").sortable({
        update: function(event, ui) {
            $(this).children().each(function(index) {
                $(this).find('td').last().html(index + 1)
            });
        }
    });





    $(document).ready(function() {
        $('#slider_table').DataTable();
    });
</script>
<script>
    $("document").ready(function() {
        setTimeout(function() {
            $("#successmsg").fadeOut('slow');
        }, 1000);
    });
</script>

<script>
    function deleteimg(id) {
        swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this Image!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location.href = "{{url('slider/delete')}}/" + id;
                } else {
                    swal("Your Image is safe!");
                }
            });
    }
</script>

@endsection