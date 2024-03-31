<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Position extends Model
{
    use HasFactory, HasSlug;

    protected $table = 'positions';

    protected $fillable = ([
        'role',
        'slug',
        'deskripsi',
        'jobdesk',
        'requirement',
        'gambar',
    ]);

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
}
