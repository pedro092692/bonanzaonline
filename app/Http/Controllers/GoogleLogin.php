<?php

namespace App\Http\Controllers;


use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Route;
use App\Providers\RouteServiceProvider;

class GoogleLogin extends Controller
{
    public function __invoke()
    {
        
        $user = Socialite::driver('google')->user();
        $userExists = User::where('external_id', $user->id)->where('external_auth', 'google')->orwhere('email', $user->email)->first();
        
        if($userExists){
            Auth::login($userExists);
        }else{
            $userNew = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'avatar' => $user->avatar,
                'external_id' => $user->id,
                'external_auth' => "google",
            ]);

           Auth::login($userNew);
        }
    
        
        
         return redirect(RouteServiceProvider::HOME);
    
       
    }
}
