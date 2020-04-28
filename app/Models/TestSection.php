<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\TranslateTable;
class TestSection extends Model
{
    use TranslateTable;
    protected $fillable = [
        "test_id", "image", "title", "title_en"
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
