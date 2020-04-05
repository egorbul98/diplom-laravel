<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Course;

class Category extends Model
{
    protected $fillable = [
        'title', 'slug'
    ];

    // public function courses()
    // {
    //     return $this->belongsToMany(Course::class, 'category_course');
    // }
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
    
}
