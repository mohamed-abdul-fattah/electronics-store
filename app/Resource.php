<?php

namespace App;

use App\Traits\PhotoTrait;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use PhotoTrait;
    
    protected $fillable = ['user_id', 'name', 'desc'];

    /**
     * Get resource photos.
     */
    public function photos()
    {
        return $this->morphMany('App\Photo', 'photoable');
    }

    /**
     * Get resource cover photo.
     */
    public function cover()
    {
        return $this->photos()->whereCover(1)->first();
    }
}
