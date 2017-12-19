@extends('layouts.app')

@section('css-styles')
{{--  Fancy Box  --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.css" />
{{--  End Fancy Box  --}}
<style media="screen">
    .fancy-images {
        text-align: center;
        margin-bottom: 10px;
    }
    .fancy-images a img {
        margin: 3px;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit {{$resource->name}}</div>

                <div class="panel-body">
                    @if($errors->any())
                        <div class="alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(count($resource->photos))
                        <div class="col-md-12 fancy-images">
                        @foreach($resource->photos as $photo)
                            <a data-fancybox="gallery" href="{{$photo->url}}"><img src="{{$photo->thumb}}"></a>
                        @endforeach
                        </div>
                    @endif
                    {{Form::open(['url' => "/resources/{$resource->id}", 'method' => 'PUT', 'class' => 'form-horizontal', 'enctype' => "multipart/form-data"])}}
                        <div class="form-group col-md-12">
                            <label for="name" class="form-label">Name</label>
                            <input id="name" name="name" type="text"
                            class="form-control" placeholder="Device name" required="required" value="{{$resource->name}}">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="desc" class="form-label">Description</label>
                            <textarea name="desc" id="desc" cols="30" rows="10" class="form-control"
                            placeholder="Device description" required="required">{{$resource->desc}}</textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="photos" class="form-label">Photos</label>
                            <input type="file" name="photos[]" multiple="multiple">
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js-scripts')
{{--  Fancy Box  --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js"></script>
{{--  End Fancy Box  --}}
@endsection