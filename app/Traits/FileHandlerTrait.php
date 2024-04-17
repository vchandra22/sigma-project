<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use File;

trait FileHandlerTrait
{
    private function uploadFile($destination, $attribute)
    {
        if (!File::isDirectory(base_path() . '/public/uploads/' . $destination)) {
            File::makeDirectory(base_path() . '/public/uploads/' . $destination, 0777, true, true);
        }

        $data['original_filename'] = $attribute->getClientOriginalName();
        $file_name = time() . Str::random(10) . '.' . pathinfo($data['original_filename'], PATHINFO_EXTENSION);
        $data['path'] = 'uploads/' . $destination . '/' . $file_name;

        try {
            $attribute->move(public_path('uploads/' . $destination . '/'), $file_name);
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }

        return $data;
    }
}
