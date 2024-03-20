<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logbook extends Model
{
    use HasFactory;

    protected $table = 'logbooks';

    protected $fillable = [
        'status_id',
        'tgl_magang',
        'jam_mulai',
        'jam_selesai',
        'topik_diskusi',
        'arahan_pembimbing',
        'arahan_pembimbing',
        'bukti',
    ];
}
