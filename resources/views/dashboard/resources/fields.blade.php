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
    <label for="cover" class="form-label">Cover</label>
    <input id="cover" type="file" name="cover">
</div>
<div class="form-group col-md-12">
    <label for="photos" class="form-label">Photos</label>
    <input id="photos" type="file" name="photos[]" multiple="multiple">
</div>
<div class="form-group col-md-12">
    <button type="submit" class="btn btn-success">Submit</button>
    <a href="/home" class="btn btn-danger">Cancel</a>
</div>