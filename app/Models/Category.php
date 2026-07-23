<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $primaryKey = 'category_id';

    protected $fillable = [
        'name',
        'parent_category_id',
        'user_id',
    ];

    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_category_id');
    }

    public function subcategories()
    {
        return $this->hasMany(Category::class, 'parent_category_id');
    }

    public function administrator()
    {
        return $this->belongsTo(Administrator::class, 'user_id');
    }

    public function contents()
    {
        return $this->hasMany(Content::class, 'category_id');
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class, 'category_id');
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class, 'category_id');
    }
}
