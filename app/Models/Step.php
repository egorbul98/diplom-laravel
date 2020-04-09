<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    protected $fillable = [
        'content', 'step_type_id'
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
    
}
