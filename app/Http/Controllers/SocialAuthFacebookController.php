<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthFacebookController extends Controller
{
    /**
   * Create a redirect method to oauth facebook api.
   *
   * @return \Illuminate\Http\Response
   */
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Return a callback method from facebook api.
     *
     * @return \Illuminate\Http\Response
     */
    public function callback()
    {
        $user     = Socialite::driver('facebook')->user();
        
        $authUser = $this->findOrCreateUser($user);
        auth()->login($authUser, true);
        return redirect('/home');
    }

    protected function findOrCreateUser($user) {
        $authUser = User::where('provider_id', $user->id)->first();
        if ($authUser) {
            return $authUser;
        }
        return User::create([
            'name'        => $user->name,
            'email'       => $user->email,
            'provider'    => 'facebook',
            'provider_id' => $user->id
        ]);
    }
}
