<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Requirement extends Model
{
    use HasFactory;

    protected $table = 'requirements';
    protected $primaryKey = 'id';

    protected $fillable = ([
        'content',
    ]);

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid =  Str::uuid()->toString();
        });
    }
}
