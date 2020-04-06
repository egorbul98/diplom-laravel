<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $fillabke = [
        "title", "description", "author_id"
    ];
    public function test_sections()
    {
        return $this->hasMany(TestSection::class);
    }

    public function modules()
    {
        return $this->belongsToMany(Module::class, 'test_module');
    }
    public function author()
    {
        return $this->belongsTo(User::class, "author_id");
    }
}
