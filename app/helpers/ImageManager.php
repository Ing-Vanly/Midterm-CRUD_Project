<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class ImageManager
{
    /**
     * Upload and process an image
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $directory Where to store the image
     * @param int $width Optional width for resizing
     * @param int $height Optional height for resizing
     * @return string Path to the stored image
     */
   public static function upload($file, $directory = 'settings', $width = null, $height = null)
{
    $filename = time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();

    $uploadPath = public_path('uploads/' . $directory);
    if (!file_exists($uploadPath)) {
        mkdir($uploadPath, 0755, true);
    }

    if ($width && $height) {
        $image = Image::make($file)->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });
        $image->save($uploadPath . '/' . $filename);
    } else {
        $file->move($uploadPath, $filename);
    }

    // Only return the filename
    return $filename;
}


    /**
     * Delete an image from storage
     *
     * @param string $path Path to the image to delete
     * @return bool
     */
    public static function delete($path)
    {
        if ($path && Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->delete($path);
        }

        return false;
    }
}
