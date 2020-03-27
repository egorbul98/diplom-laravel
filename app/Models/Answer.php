<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'title', 'value', 'error', 'type', 'step_id'
    ];

    public function steps()
    {
        return $this->belongsTo(Step::class);
    }
    
}
