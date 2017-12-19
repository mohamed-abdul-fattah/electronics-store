@extends('layouts.app')

@section('css-styles')
    <style media="screen">
        .device .row {
            background-color: #eee;
            text-align: center;
        }
    </style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Devices</div>

                <div class="panel-body">
                    <div class="row col-md-12">
                        @foreach($resources as $resource)
                            <div class="col-md-4 device">
                                <div class="row">
                                    <img src="{{$resource->cover()->thumb}}" alt="{{$resource->cover()->caption}}">
                                </div>
                                <h3><a href="/resources/{{$resource->id}}">{{$resource->name}}</a></h3>
                                <hr>
                                <p>
                                    @if(strlen($resource->desc) > 100)
                                        {{substr($resource->desc, 0, 100)}}...
                                        <a href="/resources/{{$resource->id}}">more</a>
                                    @else
                                        {{$resource->desc}}
                                    @endif
                                </p>
                                <hr>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
