<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\TranslateTable;
class AnswerTestSection extends Model
{
    use TranslateTable;
    protected $fillable = [
        "value", "value_en",  "correct", "test_section_id"
    ];

    public function test_section()
    {
        return $this->belongsTo(TestSection::class, 'test_section_id');
    }
}
