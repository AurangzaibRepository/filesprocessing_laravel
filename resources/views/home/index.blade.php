@extends('layouts.main')

@section('contents')
{{ Form::open(['route' => 'fileUpload']) }}
<div id="dv-fileupload" class="row">
    <div class="col-md-10">
        {{ Form::file('input-file') }}
    </div>
    <div class="col-md-2 justify-content-end d-flex">
        {{ Form::submit('Upload', ['class' => 'btn btn-primary']) }}
    </div>
</div>
{{ Form::close() }}

@include('home.filelist')
@endsection