<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $primaryKey = 'quiz_id';

    protected $fillable = [
        'title',
        'status',
        'category_id',
        'user_id',
    ];

    public function instructor()
    {
        return $this->belongsTo(Instructor::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'quiz_id');
    }

    public function results()
    {
        return $this->hasMany(Result::class, 'quiz_id');
    }
}
