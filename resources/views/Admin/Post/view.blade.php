@extends('layout.app')
@section('list_modules')
<div class="container-fluid p-1">
    <h4 class="ml-3 mt-2"><i class="nav-icon fas fa-users mr-1  fa-lg"></i>Post Management </h4>
    <div class="row">
        <div class="col-md-11 mx-auto">
            @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            <div class="card">

                <div class="active tab-pane" id="activity">
                    <!-- Post -->

                    <!--  -->
                    <div class="addpost" style="text-align: right;">
                        <a href="{{ url('add-post') }}" class="btn btn-info">View Post</a>
                    </div>
                    <div class="card-header bg-danger d-flex">
                        <i class="bi bi-file-earmark-post-fill" style="display:flex;"></i>
                        <h3 class="card-title">Post List </h3>
                    </div>
                    <div class="card-body">
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
                            <p><img src="{{ asset($post->post_image) }}" id="img1"
                                    style="height:150px;max-height: 150px;"></p>
                            <p><span style="font-weight: 600;">Post Description:</span> {!!$post->post_desc!!}</p>
                            <p><span style="font-weight: 600;">Post Created :</span> {{ $post->created_at }}</p>
                        </div>

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
