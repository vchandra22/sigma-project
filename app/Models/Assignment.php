<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Assignment extends Model
{
    use HasFactory, HasSlug;

    protected $table = 'assignments';
    protected $primaryKey = 'id';

    protected $fillable = [
        'status_id',
        'judul',
        'slug',
        'start_date',
        'due_date',
        'pertanyaan',
        'doc_pertanyaan',
        'doc_jawaban',
        'status',
        'created_by',
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

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('judul')
            ->saveSlugsTo('slug');
    }

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid =  Str::uuid()->toString();
        });
    }
}
