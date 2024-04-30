<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Benefit extends Model
{
    use HasFactory;

    protected $table = 'benefits';
    protected $primaryKey = 'id';

    protected $fillable = ([
        'title',
        'detail',
        'fa_icon',
    ]);

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid =  Str::uuid()->toString();
        });
    }
}
