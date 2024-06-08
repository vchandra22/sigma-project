<?php

use App\Models\Meta;
use Illuminate\Support\Carbon;

function get_app_name()
{
    return env('APP_NAME'); // mendapatkan data nama aplikasi
}

// mengubah format tanggal
function convertDate($date)
{
    $convertedDate = Carbon::createFromFormat('ymd', substr($date, 2, 2) . substr($date, 5, 2) . substr($date, 8, 2))->format('d M Y');

    return $convertedDate;
}

// Mendapatkan tahun saat ini
function get_copyright_year()
{
    $currentYear = date("Y");
    return $currentYear;
}

// Menampilkan gambar
function getImageFile($file)
{
    if ($file != '') {
        return asset('storage/img/' . $file);
    } else {
        return asset('frontend/assets/img/sigma-logo-full.png');
    }
}

function get_option($option_key, $default = NULL)
{
    $system_settings = config('settings');

    if ($option_key && isset($system_settings[$option_key])) {
        return $system_settings[$option_key];
    } elseif ($option_key && isset($system_settings[strtolower($option_key)])) {
        return $system_settings[strtolower($option_key)];
    } elseif ($option_key && isset($system_settings[strtoupper($option_key)])) {
        return $system_settings[strtoupper($option_key)];
    } else {
        return $default;
    }
}

function staticMeta($id)
{
    $meta = \App\Models\Meta::find($id);
    $metaData = [];
    if ($meta) {
        $metaData['title'] = $meta->meta_title;
        $metaData['meta_description'] = $meta->meta_description;
        $metaData['meta_keyword'] = $meta->meta_keyword;
    }

    return $metaData;
}


if (!function_exists('getMeta')) {
    function getMeta($slug)
    {
        $metaData = [
            'meta_title' => null,
            'meta_description' => null,
            'meta_keyword' => null,
            'og_image' => null,
        ];

        $meta = Meta::where('slug', $slug)->select([
            'meta_title',
            'meta_description',
            'meta_keyword',
            'og_image',
        ])->first();

        if (!is_null($meta)) {
            $metaData = $meta->toArray();
        } else {
            $meta = Meta::where('slug', 'default')->select([
                'meta_title',
                'meta_description',
                'meta_keyword',
                'og_image',
            ])->first();

            if (!is_null($meta)) {
                $metaData = $meta->toArray();
            }
        }

        $metaData['meta_title'] = $metaData['meta_title'] != NULL ? $metaData['meta_title'] : env('APP_NAME');
        $metaData['meta_description'] = $metaData['meta_description'] != NULL ? $metaData['meta_description'] : env('APP_NAME');
        $metaData['meta_keyword'] = $metaData['meta_keyword'] != NULL ? $metaData['meta_keyword'] : env('APP_NAME');
        $metaData['og_image'] = $metaData['og_image'] != NULL ? asset('storage/img/' . $metaData['og_image']) : asset('storage/img/sigma-logo-full.png');

        return $metaData;
    }
}

// Mengubah nilai ke romawi
if (!function_exists('toRoman')) {
    function toRoman($num)
    {
        $map = [
            'M'  => 1000,
            'CM' => 900,
            'D'  => 500,
            'CD' => 400,
            'C'  => 100,
            'XC' => 90,
            'L'  => 50,
            'XL' => 40,
            'X'  => 10,
            'IX' => 9,
            'V'  => 5,
            'IV' => 4,
            'I'  => 1,
        ];

        $result = '';

        foreach ($map as $roman => $value) {
            $matches = intval($num / $value);
            $result .= str_repeat($roman, $matches);
            $num %= $value;
        }

        return $result;
    }
}
