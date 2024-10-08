<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Support\Str;
use Spatie\Sluggable\HasSlug;

class Office extends Model
{
    use HasFactory, HasSlug;

    protected $table = 'offices';
    protected $primaryKey = 'id';

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

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('nama_kantor')
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
