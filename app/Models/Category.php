<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Course;
use App\Models\Traits\TranslateTable;
class Category extends Model
{
    use TranslateTable;
    protected $fillable = [
        'title', 'slug', 'title_en',
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
