<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Section;
use App\Models\Module;

class Competence extends Model
{
    protected $fillable = [
        'title', 'section_id'
    ];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function modules()
    {
        return $this->belongsToMany(Module::class, "competence_module");
    }

    public function getUpdatedAtColumn() {
        return null;
    }
    public function getCreatedAtColumn() {
        return null;
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'competence_user');
    }
}
