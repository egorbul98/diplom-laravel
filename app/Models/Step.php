<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    protected $fillable = [
        'content', 'step_type_id'
    ];
    
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
    public function modules()
    {
        return $this->belongsToMany(Module::class, 'module_step');
    }
    public function type()
    {
        return $this->belongsTo(StepType::class, "step_type_id");
    }
    
}
