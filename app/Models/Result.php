<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $primaryKey = ['quiz_id', 'user_id'];
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'quiz_id',
        'user_id',
        'score',
        'date_completed',
        'updated_at',
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'user_id');
    }
}
