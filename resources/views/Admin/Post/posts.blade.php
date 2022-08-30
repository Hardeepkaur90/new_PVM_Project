@extends('layout.app')

@section('list_modules')
<div class="container-fluid p-1" style="padding: 0.25rem!important;
    display: inline-flex;
    justify-content: space-between;">
    <h4 class="ml-3 mt-2">
    <div class="rightsection">
        <i class="nav-icon fas fa-users mr-1  fa-lg"></i>Post Management </h4>
   
      <div class="addpost"  style="text-align: right;">
         <a href="{{ url('add-post') }}"  class="btn btn-info">Add Post</a>
         </div>
      </div>
    <div class="row">
        <div class="col-md-11 mx-auto">
            @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
            @endif
            <div class="card">
          
                <div class="active tab-pane" id="activity">
               
                    <div class="card-header bg-danger d-flex" style="justify-content: space-between;">
                        <div class="leftsection">
                        <i class="bi bi-file-earmark-post-fill"style="display:flex;"></i>
                        <h3 class="card-title">Post List </h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered" id="myTable">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Title</th>
                                   
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php
                            $i = 1;
                            @endphp
                             @if($post)
                              @foreach($post as $single)
                            <tr>
                                <td>   {{$i}}</td>
                                <td> {{$single->post_name}}</td>
                               
                               
                                <td>
                              <div class="mytest">
                                <a href="#"  data-toggle="modal" data-target=".bd-example-modal-lg">    
                                  <img src="{{ asset($single->post_image) }}" class="test"  style="height:50px;width: 50px;" > 
                                 </a>
                               </div>
                                 </td>
                                <td>
                                <input data-id="{{$single->id}}" data-status="{{$single->status}}"    class="toggle-class" id="toggle" type="checkbox" data-toggle="toggle"  
                                  {{ $single->status ? 'checked' : '' }}>
                              </td>

                               <td class="width:15%;">  
                                     <a href="javascript:void(0)"  class="btn btn-danger" onClick="deletePage({{$single->id}})"><i class="bi bi-trash"></i></a>
                               
                                    <a href="{{ url('edit-post/'.$single->id) }}"  class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>

                                    <a href="{{ url('view-post/'.$single->id) }}"  class="btn btn-info"><i class="bi bi-eye-fill"></i></a>
                                    
                               </td>
                                
                            </tr>
                            @php
                            $i++;
                            @endphp
                            
                             @endforeach

                             @else if
                             <h3>"No data found"</h3>
                            @endif 

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     <img src="" id="mod" class="img-fluid" alt="test">
</div>
    </div>
  </div>
</div>
<script>

$(".mytest a img").click(function(){
var imgPath = $(this).attr("src");

console.log(imgPath);

$("#mod").attr("src",imgPath);
});

 $.ajaxSetup({
        headers: {
           'csrftoken': '{{ csrf_token() }}'
       }
   });
   $(function() {
    $('.toggle-class').change(function() {
           var status = $(this).prop('checked') == true ? 1 : 0;
           var post_id = $(this).attr('data-id');
           var post_status = $(this).attr('data-status') // in db status
    
    console.log("sending==>status",status,"post_id==>",post_id,"post_status==>db",post_status);    
        $.ajax({
               type: "POST",
               url: "{{url('changestatus')}}",
               data: {
                   '_token': '{{csrf_token()}}',
                   'status':status,
                   'post_id':post_id

               },
               success: function(data) {
                console.log(data)
               }
           });
       })
    });
   
   
 function deletePage(id){        
       swal({
           title: "Are you sure?",
           text: "Once deleted, you will not be able to recover this page!",
           icon: "warning",
           buttons: true,
           dangerMode: true,
       })
       .then((willDelete) => {
           if (willDelete) {
               window.location.href = "{{url('delete-post')}}/"+id;
           } else {
               swal("Your page is safe!");
           }
       });
   }
</script>
@endsection








