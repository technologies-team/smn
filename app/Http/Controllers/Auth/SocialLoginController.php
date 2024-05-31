<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SocialLoginController extends Controller
{
/**
* Redirect the user to the social provider's authentication page.
*
* @param  string  $provider
* @return \Illuminate\Http\Response
*/
public function redirectToProvider($provider)
{
return Socialite::driver($provider)->stateless()->redirect();
}

/**
* Obtain the user information from the social provider.
*
* @param  string  $provider
* @return \Illuminate\Http\Response
*/
public function handleProviderCallback($provider)
{
$socialUser = Socialite::driver($provider)->stateless()->user();

// Find or create the user in the database
$user = User::firstOrCreate(
['email' => $socialUser->getEmail()],
['name' => $socialUser->getName()]
);

// Log the user in
Auth::login($user);

// Create a token for the user
$token = $user->createToken('API Token')->plainTextToken;

// Return the token in the response
return response()->json(['token' => $token]);
}
}
