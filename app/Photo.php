<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'path_name', 'url', 'thumb', 'caption', 'cover', 'resourceable_id', 'resourceable_type'
    ];
}
