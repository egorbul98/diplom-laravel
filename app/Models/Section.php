<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Course;
use App\Models\Module;
use App\Models\Competence;

class Section extends Model
{
    protected $fillable = [
        'title', 'description', 'course_id'
    ];

    public function modules()
    {
        return $this->belongsToMany(Module::class, 'module_section');
    }
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function getModulesId()
    {
        $modules_section = $this->modules;
        $modules_section_ids = [];
        foreach ($modules_section as $item) {
            $modules_section_ids[] = $item->id;
        }
        return $modules_section_ids;
    }

    public function competences()
    {
        return $this->hasMany(Competence::class);
    }

    public function progress_users()
    {
        return $this->belongsToMany(User::class, 'progress_section');
    }
}
