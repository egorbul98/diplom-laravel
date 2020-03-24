<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Module;
use App\Models\Section;


class EditorSectionController extends BaseController
{
    public function edit (Course $course)
    {
         return view("profile.edit-sections.edit", compact("course"));
    }
}
