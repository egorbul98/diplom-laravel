<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
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
}
