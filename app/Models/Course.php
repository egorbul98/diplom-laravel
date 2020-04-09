<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Section;
use App\Models\Category;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Carbon\Carbon;
class Course extends Model
{
    protected $fillable = [
        'title', 'description', 'content', "slug", "category_id", "author_id", "image"
    ];

    public function author()
    {
        return $this->belongsTo(User::class);
    }
    
    public function sections()
    {
        return $this->hasMany(Section::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // public function steps()
    // {
    //     return $this->hasManyThrough('App\Comment', App\Post);
    // }
   
}
