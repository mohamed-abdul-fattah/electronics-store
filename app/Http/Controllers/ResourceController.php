<?php

namespace App\Http\Controllers;

use App\Resource;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Create a new instance of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.resources.create');
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'     => 'required|string|max:255',
            'desc'     => 'required|string',
            'cover'    => 'image',
            'photos.*' => 'image'
        ]);

        $resource = Resource::create([
            'user_id' => auth()->id(),
            'name'    => $request->name,
            'desc'    => $request->desc
        ]);

        if ($request->hasFile('cover')) {
            $resource->uploadPhoto($request->file('cover'), "$resource->name cover", 1);
        }

        if ($request->has('photos')) {
            foreach ($request->photos as $key => $photo) {
                $resource->uploadPhoto($photo, "$resource->name photo");
            }
        }

        return redirect('/home')->with(['status' => 'Device successfully created']);
    }

    /**
     * Show a resource details page.
     * 
     * @param  Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function show(Resource $resource)
    {
        return view('frontend.resources.show', compact('resource'));
    }

    /**
     * Show edit form for a resource
     * 
     * @param  Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function edit(Resource $resource)
    {
        return view('dashboard.resources.edit', compact('resource'));
    }

    /**
     * Update an existing resource.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Resource $resource)
    {
        $this->validate($request, [
            'name'     => 'required|string|max:255',
            'desc'     => 'required|string',
            'cover'    => 'image',
            'photos.*' => 'image'
        ]);

        $resource->update($request->only('name', 'desc'));

        if ($request->hasFile('cover')) {
            if ($resource->cover()) {
                $resource->cover()->update(['cover' => 0]);
            }
            $resource->uploadPhoto($request->file('cover'), "$resource->name cover", 1);
        }

        if ($request->has('photos')) {
            foreach ($request->photos as $key => $photo) {
                $resource->uploadPhoto($photo, "$resource->name photo");
            }
        }

        return redirect('/home')->with(['status' => 'Device successfully updated']);
    }

    /**
     * Delete a resource from storage.
     * 
     * @param  Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resource $resource)
    {
        if (count($resource->photos)) { // delete photos from filesystem and storage.
            foreach ($resource->photos as $key => $photo) {
                $resource->deletePhoto($photo);
            }
        }
        $resource->delete();
        return redirect('/home')->with(['status' => 'Deivce successfully deleted']);
    }
}
