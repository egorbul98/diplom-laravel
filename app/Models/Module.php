<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Section;
use App\Models\Competence;
use App\Models\Answer;
use App\Models\Step;

class Module extends Model
{
    protected $fillable = [
        'title', 'section_id'
    ];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function competences_in()
    {
        return $this->belongsToMany(Competence::class, "competence_module")->wherePivot('type', "in");
    }
    public function competences_out()
    {
        return $this->belongsToMany(Competence::class, "competence_module")->wherePivot('type', "out");
    }

    public function steps()
    {
        return $this->belongsToMany(Step::class, 'module_step');
    }
    // public function steps()
    // {
    //     return $this->hasMany(Step::class);
    // }
    
}
