@extends('layouts.app')

@section('css-styles')
{{--  Fancy Box  --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.css" />
{{--  End Fancy Box  --}}
{{--  Fontawesome  --}}
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
{{--  End Fontawesome  --}}
<style media="screen">
    .fancy-images {
        text-align: center;
        margin-bottom: 10px;
    }
    .fancy-images a {
        position: relative;
        display: inline-block;
        overflow: hidden;
    }
    .fancy-images a img {
        margin: 3px;
    }
    .fa-trash-o {
        position: absolute;
        top: 5px;
        left: 5px;
        color: red;
    }
    .fa-trash-o:hover {
        color: brown;
    }
    .fancy-images a .cover {
        position: absolute;
        right: -20px;
        top: 15px;
        transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        -webkit-transform: rotate(45deg);
        padding: 0 25px;
        background-color: #008000;
        color: #fff;
        font-size: 0.7em;
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
                            <a data-fancybox="gallery" href="{{$photo->url}}">
                                <i class="fa fa-trash-o" aria-hidden="true" data-id="{{$photo->id}}"></i>
                                 @if ($photo->cover)
                                    <span class="cover">COVER</span>
                                @endif
                                <img src="{{$photo->thumb}}" alt="{{$photo->caption}}">
                            </a>
                        @endforeach
                        </div>
                    @endif
                    {{Form::open(['url' => "/resources/{$resource->id}", 'method' => 'PUT', 'class' => 'form-horizontal', 'enctype' => "multipart/form-data"])}}
                        @include('dashboard.resources.fields')
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
<script type="text/javascript">
    $(document).ready(function () {
        $('.fa-trash-o').on('click', function (e) {
            e.preventDefault();
            const photoId  = $(this).attr('data-id'),
                  image    = $(this).parent();
            $.ajax({
                url: `/photos/${photoId}`,
                method: 'DELETE',
                contentType: 'application/json'
            }).done(res => {
                if (res.success) {
                    image.hide('fast', function () {
                        image.remove();
                    });
                }
            });
        });
    });
</script>
@endsection