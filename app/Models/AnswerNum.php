<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnswerNum extends Model
{
    protected $fillable = [
        'value', 'step_id', 'error'
    ];

    public function step()
    {
        return $this->belongsTo(Step::class);
    }
    
}
