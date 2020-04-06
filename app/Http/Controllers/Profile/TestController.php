<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Test;
use Illuminate\Http\Request;
use Gate;
class TestController extends Controller
{
   
    public function create()
    {
        $test = new Test();
        return view("profile.test.create", compact("test"));
    }
}
