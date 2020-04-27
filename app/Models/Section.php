<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Course;
use App\Models\Module;
use App\Models\Competence;
use DB;
use App\Models\Traits\TranslateTable;
class Section extends Model
{
    use TranslateTable;
    protected $fillable = [
        'title', 'description', 'course_id', 'title_en','description_en',
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
    public function competences_out_modules()//компетенции, которые выходные у модулей данного раздела
    {
        return DB::table('competences')->select("title")
            ->join("competence_module", "competence_module.competence_id", "=", "competences.id")
        ->where("competences.section_id", $this->id)
        ->where("competence_module.type", "out")
        ->groupBy("title")
        ->get();
    }

    public function progress_users()
    {
        return $this->belongsToMany(User::class, 'progress_section');
    }
}
