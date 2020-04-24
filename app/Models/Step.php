<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    protected $fillable = [
        'content', 'step_type_id', 'content_en',
    ];
    
    public function answersNum()
    {
        return $this->hasMany(AnswerNum::class);
    }
    public function answersString()
    {
        return $this->hasMany(AnswerString::class);
    }
   
    public function modules()
    {
        return $this->belongsTo(Module::class);
    }
    public function type()
    {
        return $this->belongsTo(StepType::class, "step_type_id");
    }
    
    public function progress_users()
    {
        return $this->belongsToMany(User::class, 'progress_step');
    }

    public function progress_users_for_user($user_id)
    {
        return $this->belongsToMany(User::class, 'progress_step')->wherePivot('user_id', $user_id);
    }
}
