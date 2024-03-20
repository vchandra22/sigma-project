<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Office extends Model
{
    use HasFactory;

    protected $table = 'offices';

    protected $fillable = [
        'nama_kantor',
        'slug',
        'alamat',
        'nama_kepala',
        'nip_kepala',
        'ttd_kepala',
    ];

    /**
     * Get the document associated with the Office
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function document(): HasOne
    {
        return $this->hasOne(Document::class, 'office_id', 'id');
    }

}
