<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Section;
use App\Models\Module;
use App\Models\Traits\TranslateTable;
class Competence extends Model
{
    use TranslateTable;
    protected $fillable = [
        'title', 'title_en', 'section_id'
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
