<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Support\Str;


class Publication extends Model
{
    use HasFactory, HasSlug;

    protected $table = 'publications';
    protected $primaryKey = 'id';

    protected $fillable = ([
        'judul',
        'slug',
        'content',
        'gambar',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_image'
    ]);

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
