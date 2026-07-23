<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $primaryKey = 'question_id';

    protected $fillable = [
        'quiz_id',
        'text',
        'user_id',
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class, 'user_id');
    }

    public function responses()
    {
        return $this->hasMany(Response::class, 'question_id');
    }
}
