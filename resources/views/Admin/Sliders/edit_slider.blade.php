@extends('layout.app')
@section('edit_slider')
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">

<style>
.edit-slider-section {
    width: 700px;
    margin-left: 100px;
    margin-top: 40px;
}

.slider-list {
    width: 500px;
    margin-left: 80px;
    margin-top: 40px;
    max-height: 525px;
}

/* .form-control {
    height: 49px;
    border-radius: 10px;
} */

.custom-file-input {
    height: 49px !important;
}

.update-btn {
    margin-left: 212px;
    width: 200px;
    height: 48px;
}

.form-error {

    border: 2px solid #e74c3c;
    animation: shake .1s linear;
    animation-iteration-count: 2;
}

.val-error {
    background-color: red;
    color: white;
    width: 24px;
    border-radius: 20px;
    text-align: center;
    font-weight: 600;

}

.val-wrapper {
    font-size: 13.4px;
    inline-size: 201px;
    text-align: center;
    /* background-color: #554545; */
    background-color: #b300002e;
    color: red;
    border-style: solid;
    border-width: 1px;
    display: block;
    padding: 6px;
    padding-bottom: 6px;
    font-weight: 600;
    padding-bottom: 10px;

}

#sortable {
    list-style-type: none;
    margin: 10px 0 10px 20px;
    padding: 10px;
    width: 72%;
}

#sortable li {
    margin: 8px 5px 3px 3px;

    font-size: 1.3em;
    height: 45px;
    border-radius: 14px;
    background-color: #9a9ea2ab;
    text-align: center;
}

#sortable li span {
    position: absolute;
    margin-left: -1.3em;
}

/* .li_image {

    background-repeat: no-repeat;
    background-size: 100% 211%;
    border-radius: 5px;
    flex: 2 0 53%;
    filter: blur(0.3px)
} */

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




@section('title','Update Slider')



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


<div class="" style="display:flex;">

    <div class="card card-secondary edit-slider-section">
        <div class="card-header" style="height: 65px;">
            <h3 class="card-title">Update Slider Images</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <form action="{{url('updatedimg')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <input type="hidden" value="{{$data->id}}" name="id" data-id="{{$data->id}}">
                    <label for="inputName">Image Title</label>
                    <input type="text" name="image_title" id="inputName"
                        class="form-control {{($errors->first('image_title') ? " form-error" : "")}}"
                        value="{{$data->image_title}}">
                </div>
                @if(!empty($error = $errors->first('image_title')))
                <p class="val-error" style="margin-left: 10px;margin-top: 1px;margin-bottom: 31px;">

                    @error('image_title')! @enderror</p>

                <div class="val-wrapper" style="margin-top: -62px;margin-left: 41px;margin-bottom: 22px">
                    @error('image_title'){{$message}} @enderror</div>
                @endif



                <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" name="image"
                                class="custom-file-input {{($errors->first('image') ? " form-error" : "")}}"
                                id="exampleInputFile">
                            <label class="custom-file-label" for="exampleInputFile">{{$data->image}}</label>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text">Upload</span>

                        </div>

                    </div>

                </div>
                @if(!empty($error = $errors->first('image')))
                <p class="val-error" style="margin-left: 6px;margin-top: -1px;margin-bottom: 31px;">

                    @error('image')! @enderror</p>

                <div class="val-wrapper" style="margin-top: -62px;margin-left: 41px;margin-bottom: 22px;">
                    @error('image'){{$message}} @enderror</div>
                @endif

                <div class="form-group">
                    <label for="inputDescription">Image Description</label>
                    <textarea id="summernote" name="description"
                        class="form-control {{($errors->first('description') ? " form-error" : "")}}"
                        rows="4">{{$data->description}}</textarea>
                </div>

                @if(!empty($error= $errors->first('description')))
                <p class="val-error" style="margin-left: 6px;margin-top: 21px;margin-bottom: 29px;">

                    @error('description')! @enderror</p>

                <div class="val-wrapper" style="margin-top: -62px;margin-left: 38px;margin-bottom: 81px;">
                    @error('description'){{$message}} @enderror</div>
                @endif





                <div class="form-group">
                    <button class="btn btn-secondary update-btn" type="submit">Update</button>
                </div>

            </div>
        </form>
    </div>


    <div class="card card-secondary slider-list">
        <div class="card-header">
            <h3 class="card-title">Arrange slider image order</h3>
            <div class="card-tools">
                <div class="card-body">

                </div>

            </div>
        </div>

        <ul id="sortable">
            @foreach($datalist as $value)
            <!-- style="background-image: URL('{{asset('images/slider/'.$value->image)}}')"  -->
            <li class="ui-state-default li_image" value="{{$value->id}}" name="sliderid" data-id="{{$value->id}}"
                id="sort_li">
                {{$value->image_title}}
            </li>
            @endforeach
        </ul>
    </div>


</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>




<script>
// $(function() {
//     $("#sortable").sortable();
// });

$("#sortable").sortable({
    axis: 'y',
    update: function(event, ui) {
        var id = $('#sort_li').data('id');
        var dataIds = [];
        $('[name="sliderid"]').each(function() {
            dataIds.push($(this).val());

        });
        alert(dataIds);

        $.ajax({
            url: '{{ "order" }}',
            type: 'POST',
            data: {
                id: id,
                data1: dataIds,
                '_token': '{{csrf_token()}}'
            },
            success: function(result) {
                console.log(result);

            },
            complete: function() {

            }
        });
    }

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
$(function() {
    // Summernote
    var t = $('#summernote').summernote({
        height: 250,
        focus: true
    });

    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
        mode: "htmlmixed",
        theme: "monokai"
    });
})
</script>

<!-- <script>
  
  $('#error').click(function(){
      $('.wrapper').toggle();
  });
  </script> -->
@endsection