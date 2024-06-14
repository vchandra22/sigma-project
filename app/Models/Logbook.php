<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;


class Logbook extends Model
{
    use HasFactory;

    protected $table = 'logbooks';
    protected $primaryKey = 'id';

    protected $fillable = [
        'status_id',
        'tgl_magang',
        'jam_mulai',
        'jam_selesai',
        'topik_diskusi',
        'arahan_pembimbing',
        'status',
        'bukti',
    ];

    /**
     * Get the status that owns the Logbook
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid =  Str::uuid()->toString();
        });
    }
}
