<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Journey extends Model
{
    use HasFactory;

    protected $table = 'journeys';
    protected $primaryKey = 'id';

    protected $fillable = ([
        'title',
        'detail',
    ]);

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid =  Str::uuid()->toString();
        });
    }
}
