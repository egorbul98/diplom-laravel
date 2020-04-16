<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
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

    public function progress_modules()
    {
        return $this->belongsToMany(Course::class, 'progress_module')->withPivot("complete");
    }

    public function modules_completed_for_course($course_id)
    {
        return $this->belongsToMany(Module::class, 'progress_module')->wherePivot('complete', 1)->wherePivot('course_id', $course_id);
    }
    public function modules_completed_for_section($section_id)
    {
        return $this->belongsToMany(Module::class, 'progress_module')->wherePivot('complete', 1)->wherePivot('section_id', $section_id);
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
        return $this->belongsToMany(Course::class, 'progress_step')->withPivot("complete");
    }

    public function competences()
    {
        return $this->belongsToMany(Competence::class, 'competence_user');
    }
}
