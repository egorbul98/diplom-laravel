<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Section;
use App\Models\Category;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
class Course extends Model
{
    protected $fillable = [
        'title', 'description', 'content', "slug", "category_id", "author_id"
    ];

    public function author()
    {
        return $this->belongsTo(User::class);
    }
    public function sections()
    {
        return $this->hasMany(Section::class);
    }

    // public function categories()
    // {
    //     return $this->belongsToMany(Category::class, 'category_course');
    // }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
