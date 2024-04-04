<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Support\Str;

class Faq extends Model
{
    use HasFactory, HasSlug;

    protected $table = 'faqs';
    protected $primaryKey = 'id';

    protected $fillable = ([
        'pertanyaan',
        'slug',
        'jawaban',
    ]);

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('pertanyaan')
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
