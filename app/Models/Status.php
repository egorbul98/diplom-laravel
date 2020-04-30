<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\TranslateTable;
class Status extends Model
{
    use TranslateTable;

    protected $fillable = [
        'title', 'title_en'
    ];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
