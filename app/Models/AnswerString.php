<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnswerString extends Model
{
    protected $fillable = [
        'value', 'step_id'
    ];

    public function step()
    {
        return $this->belongsTo(Step::class);
    }
    
}
