<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;

    protected $primaryKey = 'response_id';

    protected $fillable = [
        'quiz_id',
        'question_id',
        'text',
        'is_correct',
        'user_id',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class, 'user_id');
    }
}
