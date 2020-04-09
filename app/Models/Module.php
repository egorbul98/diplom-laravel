<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Section;
use App\Models\Competence;
use App\Models\Answer;
use App\Models\Step;
use Carbon\Carbon;
class Module extends Model
{
    protected $fillable = [
        // 'title', 'section_id'
        'title', 'author_id'
    ];

   public function author()
   {
       return $this->belongsTo(User::class, "author_id");
   }
    public function sections()
    {
        return $this->belongsToMany(Section::class, 'module_section');
    }

    public function competences()
    {
        return $this->belongsToMany(Competence::class, "competence_module");
    }
    public function competences_in()
    {
        return $this->belongsToMany(Competence::class, "competence_module")->wherePivot('type', "in");
    }
    public function competences_out()
    {
        return $this->belongsToMany(Competence::class, "competence_module")->wherePivot('type', "out");
    }

    // public function steps()
    // {
    //     return $this->belongsToMany(Step::class, 'module_step');
    // }
   
    public function steps()
    {
        return $this->hasMany(Step::class);
    }
    public function test()
    {
        return $this->belongsTo(Test::class);
    }

    // public function getCreatedAtAttribute($date)
    // {
    //     return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    // }

    // public function getUpdatedAtAttribute($date)
    // {
    //     return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    // }
    
}
