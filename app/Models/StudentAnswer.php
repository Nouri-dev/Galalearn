<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAnswer extends Model
{
    use HasFactory;

    protected $primaryKey = ['user_id', 'quiz_id', 'question_id', 'response_id'];
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'quiz_id',
        'question_id',
        'response_id',
        'created_at',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'user_id');
    }

    public function response()
    {
        return $this->belongsTo(Response::class, ['quiz_id', 'question_id', 'response_id']);
    }
}
