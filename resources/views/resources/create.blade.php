@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create new device</div>

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
                    <form action="/resources" method="post" class="form-horizontal">
                        {{csrf_field()}}
                        <div class="form-group col-md-12">
                            <label for="name" class="form-label">Name</label>
                            <input id="name" name="name" type="text"
                            class="form-control" placeholder="Device name" required="required">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="desc" class="form-label">Description</label>
                            <textarea name="desc" id="desc" cols="30" rows="10" class="form-control"
                            placeholder="Device description" required="required"></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection