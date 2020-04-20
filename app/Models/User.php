<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use DB, Carbon\Carbon;
use App\Models\Pivots\Progress_Module;

class User extends Authenticatable
{

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', "lastname"
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function courses()
    {
        return $this->hasMany('App\Models\Course', 'author_id');
    }
    public function modules()
    {
        return $this->hasMany(Module::class, 'author_id');
    }
    public function tests()
    {
        return $this->hasMany(Test::class, 'author_id');
    }

    public function progress_courses()
    {
        return $this->belongsToMany(Course::class, 'progress_course')->withPivot("complete", "forget");
    }

    public function progress_sections()
    {
        return $this->belongsToMany(Section::class, 'progress_section')->withPivot("complete");
    }

    public function sections_completed($course_id)
    {
        return $this->belongsToMany(Section::class, 'progress_section')->wherePivot('complete', 1)->wherePivot('course_id', $course_id);
    }
    public function sections_completed_ids($course_id)
    {
        $sections_completed = $this->sections_completed($course_id)->get();
        $sections_completed_ids = [];
        foreach ($sections_completed as $item) {
            $sections_completed_ids[] = $item->id;
        }
        return $sections_completed_ids;
    }

    public function forget_modules()
    {
        return $this->belongsToMany(Module::class, 'modules_repetition_user');
    }

    public function progress_modules()
    {
        return $this->belongsToMany(Course::class, 'progress_module')
            ->withPivot("complete")->withPivot("repetition")->using(Progress_Module::class);
    }

    public function modules_completed_for_course($course_id)
    {
        return $this->belongsToMany(Module::class, 'progress_module')->withPivot("repetition")->wherePivot('complete', 1)->wherePivot('course_id', $course_id)->using(Progress_Module::class);
    }

    public function modules_forget_for_course($course_id) //carbon - Текущее время //Получаем модули, для которых уже подошел срок повторения
    {
        return $this->belongsToMany(Module::class, 'progress_module')
            ->withPivot("complete")->withPivot("repetition")->withPivot("section_id")->using(Progress_Module::class)->wherePivot('complete', 1)->wherePivot('course_id', $course_id)->wherePivot('repetition', '<=', new Carbon());
    }

    public function modules_completed_for_section($section_id)
    {
        return $this->belongsToMany(Module::class, 'progress_module')->using(Progress_Module::class)->wherePivot('complete', 1)->wherePivot('section_id', $section_id);
    }
    public function id_modules_completed_for_section($section_id)
    {
        $modules_completed = $this->modules_completed_for_section($section_id)->get();
        $modules_completed_ids = [];
        foreach ($modules_completed as $item) {
            $modules_completed_ids[] = $item->id;
        }
        return $modules_completed_ids;
    }
    public function progress_steps()
    {
        return $this->belongsToMany(Step::class, 'progress_step')->withPivot("complete")->withPivot("course_id")->withPivot("module_id");
    }

    public function competences()
    {
        return $this->belongsToMany(Competence::class, 'competence_user');
    }

    public function tests_completed()
    {
        return $this->belongsToMany(Test::class, 'module_test_user');
    }

    public function competences_out_for_course($course_id) //компетенции, которые освоил user в данном курсе
    {
        return DB::table('competences')->select("competences.title")
            ->join("competence_user", "competence_user.competence_id", "=", "competences.id")
            ->join("sections", "competences.section_id", "=", "sections.id")
            ->where("sections.course_id", $course_id)
            ->where("competence_user.user_id", $this->id)
            ->groupBy("competences.title")
            ->get();
    }
}
