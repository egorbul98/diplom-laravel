<?php

namespace App\Http\Controllers\Profile;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Gate;
class ProfileController extends BaseController
{
    public function index()
    {
        return view("profile.index");
    }
    
    public function tests()
    {
        return view("profile.test.index");
    }
    
    public function settings()
    {
        return view("profile.index");
    }
}
