<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Filesystem\Factory as Filesystem;
use Intervention\Image\Facades\Image;

class StorageService
{

    protected $storage;

    /**
     * StorageService constructor.
     * @param Filesystem $storage
     */
    public function __construct(Filesystem $storage)
    {
        $this->storage = $storage;
    }

    /**
     * @param $disk
     * @return mixed
     */
    public function getStorage($disk)
	{
		return $this->storage->disk($disk);
	}

    /**
     * @param $file
     * @return mixed
     */
    public function deleteFrom($folder, $filename)
	{
        if(! $this->storage->disk($folder)->exists($filename)){
            return false;
        }

        return $this->storage->disk($folder)->delete($filename);
    }

    /**
     * @param $folder
     * @param $request
     * @return string
     */
    public function uploadFile($folder, $request)
    {
        if($request->hasFile($folder)){
            $file = $request->file($folder);
            $filename = str_slug($request->title).'.'.$file->getClientOriginalExtension();

            if($this->getStorage($folder)->exists($filename)){
                $this->deleteFrom($folder, $filename);
            }

            $this->storage->putFileAs(
                $folder, $file, $filename
            );

            return $filename;
        } else {
            return null;
        }
    }

    public function uploadImage($request)
    {
        if($request->hasFile('course_image')){
            $image = $request->file('course_image');
            $filename = str_slug($request->title).'.'.$image->getClientOriginalExtension();

            if($this->getStorage('images')->exists($filename)){
                $this->deleteFrom('images', $filename);
            }

            $path = storage_path('app/public/images/'.$filename);

            Image::make($request->file('course_image'))->fit(360, 260)->save($path);

            return $filename;
        } else {
            return null;
        }

    }
}