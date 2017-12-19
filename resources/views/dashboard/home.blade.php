@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="/resources/create" class="btn btn-success">Create new device</a>
                </div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table">
                        <thead>
                            <th>Name</th>
                            <th>Description</th>
                            <th></th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach($resources as $resource)
                                <td>{{$resource->name}}</td>
                                <td>
                                    @if(strlen($resource->desc) > 70)
                                        {{substr($resource->desc, 0, 70)}}...
                                    @else
                                        {{$resource->desc}}
                                    @endif
                                </td>
                                <td>
                                    <a href="/resources/{{$resource->id}}/edit" class="btn btn-warning">Edit</a>
                                </td>
                                <td>
                                    {{Form::open(['url' => "resources/{$resource->id}", 'method' => 'DELETE'])}}
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    {{Form::close()}}
                                </td>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
