<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $table = 'assignments';

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
}
