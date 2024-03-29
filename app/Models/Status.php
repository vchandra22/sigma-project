<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Status extends Model
{
    use HasFactory;

    protected $table = 'statuses';

    protected $fillable = [
        'document_id',
        'status',
        'keterangan',
        'doc_balasan',
    ];

    /**
     * Get all of the logbook for the Status
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function logbook(): HasMany
    {
        return $this->hasMany(Logbook::class, 'status_id', 'id');
    }

}
