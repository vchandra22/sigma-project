<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homepage extends Model
{
    use HasFactory;

    protected $table = 'homepages';

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
}
