<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Document extends Model
{
    use HasFactory;

    protected $table = 'documents';

    protected $fillable = [
        'user_id',
        'office_id',
        'no_identitas',
        'jurusan',
        'instansi_asal',
        'u_tgl_mulai',
        'u_tgl_selesai',
        'e_tgl_mulai',
        'e_tgl_selesai',
        'doc_pengantar',
        'doc_kesbang',
        'doc_proposal',
        'doc_laporan',
    ];

    /**
     * Get the user associated with the Document
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function status(): HasOne
    {
        return $this->hasOne(Status::class, 'document_id', 'id');
    }
}
