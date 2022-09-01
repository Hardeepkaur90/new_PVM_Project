@extends('layout.app')
@section('faq_list')
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
@section('title','View FAQ')




<div>
    @if(Session::has('fail'))
    <div class="alert alert-danger" role="alert">
        {{(Session::get('fail'))}}
    </div>
    @endif

    @if(Session::has('success'))
    <div class="alert alert-success" role="alert" id="successmsg"> <i class="fa fa-check"></i>
        {{(Session::get('success'))}}
    </div>
    @endif
</div>

<div class="container-fluid rounded">
    <div class="d-flex  justify-content-between p-2">
        <div>
            <h2 class="mt-1 ml-2"> <i class="bi bi-clipboard-data mr-1"></i> FAQ Management </h2>
        </div>
        <div class="mt-1">
            <a href="<?= url('add-faq'); ?>" class="btn btn-info"> Add FAQ </a>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-11 mx-auto rounded shadow-lg p-3 rounded">
            <div class="d-flex  justify-content-between">
                <span>
                    <h4> <i class="bi bi-table ml-3 mt-5"></i> FAQ List Table </h4>
                </span>
            </div>
            <div class="container mt-2">
                <table class="table table-hover" id="faq_table">
                    <thead>
                        <tr class="bg-white">
                            <th>S.no</th>
                            <th>Questions</th>
                            <th>Answers</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $val)
                        <tr class="bg-white">
                            <td> {{ $loop->iteration }}</td>
                            <td>{{$val->question}}</td>
                            <td>{!!$val->answer!!}</td>

                            <td class="bg-white" style="width:15%;">
                                <a href="{{"faq/edit/" .$val->id}}" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger btn-sm"
                                    onclick="deletefaq({{$val->id}})"><i class="bi bi-trash"></i></a>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert@2.1.2/dist/sweetalert.min.js"></script>
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#faq_table').DataTable();
});
</script>
<script>
function deletefaq(id) {
    swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                window.location.href = "{{url('faq/delete/')}}/" + id;
            } else {
                swal("Faq is not removed!");
            }
        });
}
</script>
<script>
$("document").ready(function() {
    setTimeout(function() {
        $("#successmsg").fadeOut('slow');
    }, 1000);
});
</script>
@endsection