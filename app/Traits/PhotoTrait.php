<?php

namespace App\Traits;

use Image;
use App\Photo;

trait PhotoTrait 
{
    /**
     * Upload a photo for a resource.
     * 
     * @param  file  $file
     * @param  string  $caption
     * @param  int  $cover
     * @return void
     */
    public function uploadPhoto($file, $caption, $cover = 0) {
        $img   = new Photo;
        $name  = microtime(true)*10000 . $file->getClientOriginalName();
        $file->move('images/resources', $name); // store in filesystem.
        // Make thumb photo.
        $thumb = Image::make(public_path("/images/resources/{$name}"))
            ->fit(200, 200)
            ->save(public_path("/images/resources/thumb-{$name}"));

        $this->photos()->create([
            'caption'   => $caption,
            'path_name' => $name,
            'url'       => "/images/resources/{$name}",
            'thumb'     => "/images/resources/thumb-{$name}",
            'cover'     => $cover
        ]);
    }

    /**
     * Delete a photo from filesystem and storage.
     * 
     * @param  object  $photo
     * @return void
     */
    public function deletePhoto($photo)
    {
        @unlink(public_path("images/resources/{$photo->path_name}"));
        @unlink(public_path("images/resources/thumb-{$photo->path_name}"));
        $photo->delete();
    }
}