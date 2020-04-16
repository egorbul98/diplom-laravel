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
    public function competences_in_ids()
    {
        $competences_in = $this->competences_in;
        $competences_in_ids = [];
        foreach ($competences_in as $item) {
            $competences_in_ids[] = $item->id;
        }
        return $competences_in_ids;
    }
    public function competences_out()
    {
        return $this->belongsToMany(Competence::class, "competence_module")->wherePivot('type', "out");
    }
    public function competences_out_ids()
    {
        $competences_out = $this->competences_out;
        $competences_out_ids = [];
        foreach ($competences_out as $item) {
            $competences_out_ids[] = $item->id;
        }
        return $competences_out_ids;
    }
   
    public function steps()
    {
        return $this->hasMany(Step::class);
    }

    public function steps_ids()
    {
        $steps = $this->steps;
        $steps_ids = [];
        foreach ($steps as $item) {
            $steps_ids[] = $item->id;
        }
        return $steps_ids;
    }


    public function test()
    {
        return $this->belongsTo(Test::class);
    }

    public function progress_users()
    {
        return $this->belongsToMany(User::class, 'progress_module');
    }
    public function progress_steps_for_user($user_id)
    {
       return $this->belongsToMany(Step::class, 'progress_step')->wherePivot('user_id', $user_id)->withPivot("complete");
    }

    public function test_completed()
    {
        return $this->belongsToMany(Test::class, 'module_test_user')->withPivot("user_id");
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
