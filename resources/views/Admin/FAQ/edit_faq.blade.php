@extends('layout.app')
@section('edit_faq')
<style>
.form-error {

    border: 2px solid #e74c3c;
    animation: shake .1s linear;
    animation-iteration-count: 2;
}

.update-button {
    margin-left: 500px;
    margin-top: 20px;
    width: 221px;
    height: 48px;

}

.form-control {
    height: 49px;
    border-radius: 10px;
}

label {
    font-size: 17px;
    color: #343a40 !important;
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
@section('title','Update FAQ')



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
    <div class="row">
        <div class="col-md-5">
            <h2 class="mt-2 ml-2"> <i class="bi bi-clipboard-data mr-1"></i> FAQ Management </h2>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-10 mx-auto rounded shadow-lg p-3 rounded">
            <div class="d-flex  justify-content-between">
                <span>
                    <h4> <i class="bi bi-file-earmark-plus"></i> Update FAQ </h4>
                </span>
            </div>
            <div class="container mt-5">
                <!-- @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
                @endif -->
                <form class="form-horizontal" method="Post" action="{{url('updatedfaq')}}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <input type="hidden" value="{{$data->id}}" name="id">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Question</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputName2" placeholder="Page Title"
                                name="question" value="{{$data->question}}">
                            @if(!empty($error= $errors->first('question')))
                            <p class="val-error" style="margin-left: 6px; margin-top: 11px;margin-bottom: 31px;">
                                @error('question')! @enderror</p>

                            <div class="val-wrapper" style="margin-left: 41px;margin-bottom: 22px;margin-top: -59px;">
                                @error('question'){{$message}} @enderror</div>
                            @endif
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Answer</label>
                        <div class="col-sm-10">
                            <textarea id="summernote" name="answer">{{$data->answer}}
                            </textarea>
                            @if(!empty($error= $errors->first('answer')))
                            <p class="val-error" style="margin-left: 6px;margin-top:9px;margin-bottom: 31px;">
                                @error('answer')! @enderror</p>

                            <div class="val-wrapper" style="margin-top: -55px;margin-left: 44px;margin-bottom: 71px;">
                                @error('answer'){{$message}} @enderror</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
@endsection