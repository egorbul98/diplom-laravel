<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\TranslateTable;
class StepType extends Model
{
    use TranslateTable;
    protected $fillable = [
        'title', 'description', 'title_en', 'description_en',
    ];
    
}
