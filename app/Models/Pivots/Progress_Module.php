<?php

namespace App\Models\Pivots;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
class Progress_Module extends Pivot
{
    // let's use date mutator for a field
    protected $dates = ['repetition', "completed_at"];
    protected $table = "progress_module";

}
