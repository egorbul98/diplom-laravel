<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnswerTestSection extends Model
{
    protected $fillable = [
        "value", "correct", "test_section_id"
    ];

    public function test_section()
    {
        return $this->belongsTo(TestSection::class, 'test_section_id');
    }
}
