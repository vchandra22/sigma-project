<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $table = 'documents';

    protected $fillable = [
        'user_id',
        'no_identitas',
        'jurusan',
        'u_tgl_mulai',
        'u_tgl_selesai',
        'e_tgl_mulai',
        'e_tgl_selesai',
        'doc_pengantar',
        'doc_kesbang',
        'doc_proposal',
        'doc_laporan',
    ];

}
