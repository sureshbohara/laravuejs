<?php

namespace App\Repositories;

use App\Models\Setting;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Helpers\ImageHelper;

class SettingRepository
{
    public function update(int $id, array $data)
    {
        $setting = Setting::find($id);
        if (!$setting) {
            throw new ModelNotFoundException("Setting not found");
        }

        // Fields that need image handling
        $image_fields = [
            'logo', 'favicon', 'loader', 'bg_image', 'image1', 'image2', 'image3', 'image4', 'image5', 'image6', 'image7', 'image8'
        ];

        foreach ($image_fields as $field) {
            if (isset($data[$field])) {
                // Handle image deletion and uploading new image
                $oldImage = $setting->{$field};
                if ($oldImage) {
                    ImageHelper::deleteImage($oldImage, 'images');
                }

                $data[$field] = ImageHelper::uploadImage($data[$field], '/images', $oldImage);
            }
        }

        // Update the settings
        $setting->update($data);
        return $setting;
    }
}
