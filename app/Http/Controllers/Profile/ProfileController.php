<?php

namespace App\Http\Controllers\Profile;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends BaseController
{
    public function index()
    {
        return view("profile.index");
    }
    
    public function settings()
    {
        return view("profile.index");
    }
}
