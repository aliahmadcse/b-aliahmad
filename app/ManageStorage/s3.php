<?php

namespace App\ManageStorage;

use Illuminate\Support\Facades\Storage;

class s3
{
    /**
     * cube name for storing files
     */
    private const CUBE = "xo1u1n70b8rq/";

    /**
     *  saves and return the saved file url
     *
     * @param [object] $file the file to be stored 
     * @param [string] $dir
     * @return file url
     */
    public static function save($file = null, $dir = null)
    {
        $filePath = $file->store(self::CUBE . $dir, 's3');
        return Storage::disk('s3')->url($filePath);
    }

    /**
     * Deletes a file from storage
     *
     * @param [string] $imagePath
     * @return void
     */
    public static function delete($imagePath = null)
    {
        Storage::disk('s3')->delete(self::CUBE . $imagePath);
    }
}
