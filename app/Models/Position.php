<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Support\Str;


class Position extends Model
{
    use HasFactory, HasSlug;

    protected $table = 'positions';
    protected $primaryKey = 'id';

    protected $fillable = ([
        'role',
        'slug',
        'deskripsi',
        'jobdesk',
        'requirement',
        'gambar',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_image'
    ]);

    /**
     * Get the document associated with the Office
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function document(): HasOne
    {
        return $this->hasOne(Document::class, 'position_id', 'id');
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('role')
            ->saveSlugsTo('slug')
            ->preventOverwrite();
    }

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid =  Str::uuid()->toString();
        });
    }
}
