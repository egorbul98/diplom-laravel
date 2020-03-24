<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Section;

class Module extends Model
{
    protected $fillable = [
        'title', 'section_id'
    ];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
