<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Homepage extends Model
{
    use HasFactory;

    protected $table = 'homepages';
    protected $primaryKey = 'id';

    protected $fillable = ([
        'heading',
        'deskripsi_app',
        'instagram_username',
        'instagram_link',
        'youtube_channel',
        'youtube_link',
        'id_video',
        'alamat',
        'email',
        'no_telp',
        'gmaps_kantor',
    ]);


    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid =  Str::uuid()->toString();
        });
    }
}
