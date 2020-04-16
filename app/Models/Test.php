<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $fillable = [
        "title", "description", "author_id", "count_questions"
    ];
    public function test_sections()
    {
        return $this->hasMany(TestSection::class);
    }

    // public function modules()
    // {
    //     return $this->belongsToMany(Module::class, 'test_module');
    // }
    public function modules()
    {
        return $this->hasMany(Module::class);
    }
    public function author()
    {
        return $this->belongsTo(User::class, "author_id");
    }

    public function getModulesId()
    {
        $modules = $this->modules;
        $modules_ids = [];
        foreach ($modules as $item) {
            $modules_ids[] = $item->id;
        }
        return $modules_ids;
    }
}
