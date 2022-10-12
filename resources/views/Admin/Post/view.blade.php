@extends('layout.app')
@section('list_modules')
<div class=" p-2 d-flex justify-content-between">
    <h2 class="ml-3 mt-2"><i class="nav-icon fas fa-users mr-1  fa-lg"></i> Post Management </h2>
</div>



<div class="row mt-3">
    <div class="col-md-10 mx-auto">
        @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
        @endif
        <!-- <div class="card bg-light"> -->
        <div class="card">

            <div class="active tab-pane" id="activity">
                <!-- Post -->

                <!--  -->
                <!-- <div class="addpost" style="text-align: right;">
        <a href="{{ url('add-post') }}" class="btn btn-info">View Post</a>
    </div> -->
                <div class="card-body">
                    <h3><i class="bi bi-view-stacked"></i> Post View </h3>
                    <div class="card-body">
                        <p><span style="font-weight: 600;">User Name:</span> {{ Auth::user()->name }}</p>
                        <p><span style="font-weight: 600;">Post Title:</span> {{ $post->post_name }}</p>
                        <p><span style="font-weight: 600;">Post Slug:</span> {{ $post->post_slug }}</p>
                        <p><span style="font-weight: 600;">Post Status:</span>
                            @if($post->post_slug == 0)
                            inactive
                            @else
                            Active
                            @endif
                        </p>
                        <p><img src="{{ asset($post->post_image) }}" id="img1" style="height:150px;max-height: 150px;"></p>
                        <p><span style="font-weight: 600;">Post Description:</span> {!!$post->post_desc!!}</p>
                        <p><span style="font-weight: 600;">Post Created :</span> {{ $post->created_at }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>








<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
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