<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Module;

class Answer extends Model
{
    protected $fillable = [
        'title', 'value', 'error', 'type', 'module_id'
    ];

    public function modules()
    {
        return $this->belongsTo(Module::class);
    }
    
}
