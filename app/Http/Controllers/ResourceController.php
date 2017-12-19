<?php

namespace App\Http\Controllers;

use App\Resource;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    /**
     * Create a new instance of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('resources.create');
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
            'name' => 'required|string|max:255',
            'desc' => 'required|string'
        ]);

        $resource = Resource::create([
            'user_id' => auth()->id(),
            'name'    => $request->name,
            'desc'    => $request->desc
        ]);

        return redirect('/home')->with(['status' => 'Device successfully created']);
    }
}
