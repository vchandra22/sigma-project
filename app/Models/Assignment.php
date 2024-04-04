<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Assignment extends Model
{
    use HasFactory;

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

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid =  Str::uuid()->toString();
        });
    }
}
