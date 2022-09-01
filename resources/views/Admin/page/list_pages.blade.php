@extends('layout.app')
@section('listpages')


<div class="container-fluid rounded">
    <div class="d-flex  justify-content-between p-2">
        <div>
            <h2 class="mt-1 ml-2"> <i class="bi bi-clipboard-data mr-1"></i> Page Management </h2>
        </div>
        <div class="mt-1">
            <a href="{{route('add/pages')}}" class="btn btn-info"> Add Pages </a>
        </div>
    </div>
    
    
    
    <div class="row mt-2">
        <div class="col-md-11 mx-auto rounded shadow-lg p-3 rounded">
            <div class="d-flex  justify-content-between">
                <span>
                    <h4> <i class="bi bi-table ml-3 mt-5"></i> Page List Table </h4>
                </span>
            </div>
            <div class="container mt-2">
                
            
            <table class="table table-hover" id="page_table">
                    <thead>
                        <tr class="bg-white">
                            <th scope="col">S.No</th>
                            <th scope="col">Title</th>
                            <th scope="col">Image</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pages as $p_data)
                        <tr class="bg-white">
                            <th>{{$loop->iteration}}</th>
                            <td>{{$p_data->title}}</td>
                            <td><img src="{{asset('Page_images').'/'.$p_data->image}}" alt="" style="height:40px;"></td>
                            <td>
                                <input data-id="{{$p_data->id}}" data-status="{{$p_data->status}}" class="toggle-class" id="toggal" type="checkbox" data-toggle="toggle"  
                                {{ $p_data->status ? 'checked' : '' }}>
                            </td>

                            <td class="width:15%;">
                                <a href="{{url('edit/pages',['id'=>$p_data->id])}}" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="deletePage({{$p_data->id}})"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            
            
            
            </div>
        </div>
    </div>
</div>

<!-- <div class="container">
    {!! $dataTable->table() !!}
    {!! $dataTable->scripts() !!}
<div> -->

</div>
</div>
<!-- Button trigger modal -->
<script>
    $.ajaxSetup({
        headers: {
            'csrftoken': '{{ csrf_token() }}'
        }
    });
    $(function() {
        $('.toggle-class').change(function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var p_id = $(this).data('id');
            var p_status = $(this).data('status')

            $.ajax({
                type: "POST",
                url: "{{url('changestatus')}}",
                data: {
                    'status': p_status,
                    'p_id': p_id,
                    '_token': '{{csrf_token()}}'
                },
                success: function(data) {
                    console.log(data.success)
                }
            });
        })
    })

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
                   window.location.href = "{{url('delete/page')}}/" + id;
               } else {
                   swal("Your page is safe!");
               }
           });
   }

    $(document).ready(function() {
        $('#page_table').DataTable();
    });
</script>
@endsection