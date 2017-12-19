@extends('layouts.app')

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
                    {{Form::open(['url' => "/resources/{$resource->id}", 'method' => 'PUT', 'class' => 'form-horizontal'])}}
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
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection