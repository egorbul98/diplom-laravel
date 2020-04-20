<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Section;
use App\Models\Category;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Carbon\Carbon, DB;
class Course extends Model
{
    protected $fillable = [
        'title', 'description', 'content', "slug", "category_id", "author_id", "image", "knowledge"
    ];

    public function author()
    {
        return $this->belongsTo(User::class);
    }
    
    public function sections()
    {
        return $this->hasMany(Section::class);
    }
    
    public function modules()
    {
        return $this->belongsToMany(Module::class, "module_section");
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function progress_users()
    {
        return $this->belongsToMany(User::class, 'progress_course')->withPivot("forget");
    }

    public function progress_sections()
    {
        return $this->belongsToMany(Section::class, 'progress_section')->withPivot("complete");
    }
    public function progress_sections_completed()
    {
        return $this->belongsToMany(Section::class, 'progress_section')->withPivot("complete")->wherePivot("complete", 1);
    }
    public function tests()//Тесты курса и к каим модулям они прикреплены
    {
        $tests = DB::table('tests')
        ->select("tests.id as test_id", "modules.id as module_id", "modules.title as module_title")
        ->join("modules", "modules.test_id", "=","tests.id")
        ->join("module_section", "module_section.module_id", "=","modules.id")
        ->where("module_section.course_id", $this->id)->get();
        return $tests;
    }
    // public function procent_progress_for_user($user_id)
    // {
    //     $procent = DB::table('course')
    //     ->join
    // }


   
}
