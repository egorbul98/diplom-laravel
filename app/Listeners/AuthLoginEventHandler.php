<?php

namespace App\Listeners;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Auth;

class AuthLoginEventHandler extends ServiceProvider
{
    
   /**
     * Create the event handler.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

     
    public function handle()
    {
        $user = Auth::user();
        if($user!=null){
            session(["locale"=>$user->language]);
        }   
    }
}
