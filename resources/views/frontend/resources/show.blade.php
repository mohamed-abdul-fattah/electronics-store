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
    .resource-desc p {
        text-align: justify;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{$resource->name}}</div>

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
                            <a data-fancybox="gallery" href="{{$photo->url}}">
                                <img src="{{$photo->thumb}}" alt="{{$photo->caption}}">
                            </a>
                        @endforeach
                        </div>
                    @endif
                    <div class="col-md-12 resource-desc">
                        <h3>Description</h3>
                        <hr>
                        <p>{{$resource->desc}}</p>
                        <hr>
                    </div>
                    <div class="col-md-12">
                        <a href="/home" class="btn btn-danger">Back</a>
                    </div>
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