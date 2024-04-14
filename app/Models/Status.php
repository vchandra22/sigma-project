<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Status extends Model
{
    use HasFactory;

    protected $table = 'statuses';
    protected $primaryKey = 'id';

    protected $fillable = [
        'document_id',
        'status',
        'keterangan',
        'doc_balasan',
    ];

    /**
     * Get the document that owns the Status
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function document(): BelongsTo
    {
        return $this->belongsTo(Document::class, 'document_id', 'id');
    }

    /**
     * Get all of the logbook for the Status
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function logbook(): HasMany
    {
        return $this->hasMany(Logbook::class, 'status_id', 'id');
    }

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid =  Str::uuid()->toString();
        });
    }

}
