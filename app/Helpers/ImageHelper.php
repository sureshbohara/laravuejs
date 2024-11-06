<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class ImageHelper
{
    public static function uploadImage($file, string $path, string $oldImage = null): ?string
    {
        if ($file) {
            // Delete old image if it exists
            if ($oldImage) {
                self::deleteImage($oldImage, $path);
            }

            // Sanitize file name
            $name = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->storeAs($path, $name, 'public');

            return $name;
        }
        return null;
    }

    public static function uploadImageWithThumbnail($file, string $path, string $oldImage = null): array
    {
        if ($file) {
            // Delete old image and thumbnail if they exist
            if ($oldImage) {
                self::deleteImage($oldImage, $path);
                self::deleteThumbnail($oldImage, $path);
            }

            // Sanitize file name and generate new names
            $imageName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $thumbnailName = Str::random(8) . '.' . $file->getClientOriginalExtension();

            // Save image and thumbnail
            $image = Image::make($file);
            Storage::put($path . '/' . $thumbnailName, (string) $image->resize(230, 230)->encode());
            $file->storeAs($path, $imageName, 'public');

            return [$imageName, $thumbnailName];
        }
        return [null, null];
    }

    public static function deleteImage(string $filename, string $path)
    {
        $filePath = 'public/' . $path . '/' . $filename;
        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
        }
    }

    public static function deleteThumbnail(string $filename, string $path)
    {
        $thumbnailName = pathinfo($filename, PATHINFO_FILENAME) . '.' . pathinfo($filename, PATHINFO_EXTENSION);
        $thumbnailPath = 'public/' . $path . '/' . $thumbnailName;
        if (Storage::exists($thumbnailPath)) {
            Storage::delete($thumbnailPath);
        }
    }

    private function deleteGalleryImages(array $galleryImages){
    foreach ($galleryImages as $imageName) {
        ImageHelper::deleteImage($imageName, 'images');
    }
   }

}
