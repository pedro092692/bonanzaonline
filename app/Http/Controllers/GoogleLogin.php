<?php

namespace App\Http\Controllers;


use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Route;
<<<<<<< HEAD
use Closure;
=======
use App\Providers\RouteServiceProvider;
>>>>>>> 9e689f40eeed66c68076929badaf3c14b9f0f08e

class GoogleLogin extends Controller
{
    public function __invoke(Request $request, Closure $next)
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
    
        
        
<<<<<<< HEAD
        return $next($request);
        
=======
         return redirect(RouteServiceProvider::HOME);
>>>>>>> 9e689f40eeed66c68076929badaf3c14b9f0f08e
    
       
    }
}
