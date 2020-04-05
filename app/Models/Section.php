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
    // public function modules()
    // {
    //     return $this->hasMany(Module::class);
    // }

    public function competences()
    {
        return $this->hasMany(Competence::class);
    }
}
