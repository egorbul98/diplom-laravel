<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestSection extends Model
{
    protected $fillabke = [
        "test_id", "image"
    ];

    public function test()
    {
        return $this->belongsTo(Test::class);
    }
    public function answers()
    {
        return $this->hasMany(AnswerTestSection::class, 'test_section_id');
    }
}
