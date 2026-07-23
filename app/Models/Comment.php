<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $primaryKey = 'comment_id';

    public $timestamps = false;

    protected $fillable = [
        'text',
        'user_id',
        'blog_id',
        'created_at',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'user_id');
    }

    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blog_id');
    }
}
