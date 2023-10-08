<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class FacebookLogin extends Controller
{
    public function __invoke()
    {
        $user = Socialite::driver('facebook')->user();
        $userExists = User::where('external_id', $user->id)->where('external_auth', 'facebook')->orwhere('email', $user->email)->first();
        
        if($userExists){
            Auth::login($userExists);
        }else{
            $userNew = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'avatar' => $user->avatar,
                'external_id' => $user->id,
                'external_auth' => "facebook",
            ]);

            Auth::login($userNew);
        }

        return back();
    }
    
}
