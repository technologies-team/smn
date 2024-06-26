<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use League\OAuth2\Client\Provider\GenericProvider;

class OAuthController extends Controller
{
    public GenericProvider $provider;

    public function __construct ()
    {
        $appUrl = env("AUTHGEAR_PROJECT_URL", "");
        $this->provider = new GenericProvider([
            'clientId'            	=> env("AUTHGEAR_APP_CLIENT_ID", ""),
            'clientSecret'        	=> env("AUTHGEAR_APP_CLIENT_SECRET", ""),
            'redirectUri'         	=> env("AUTHGEAR_APP_REDIRECT_URI", ""),
            'urlAuthorize'        	=> $appUrl.'/oauth2/authorize',
            'urlAccessToken'      	=> $appUrl.'/oauth2/token',
            'urlResourceOwnerDetails' => $appUrl.'/oauth2/userInfo',
            'scopes' => 'openid'
        ]);
    }

    public function startAuthorization(): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $authorizationUrl = $this->provider->getAuthorizationUrl();
        return redirect($authorizationUrl);
    }

    public function handleRedirect()
    {

        // if code is set, get access token
        $accessToken = null;
        if (isset($_GET['code'])) {
            $code = $_GET['code'];

            try {
                $accessToken = $this->provider->getAccessToken('authorization_code', [
                    'code' => $code
                ]);

            } catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {

                // Failed to get the access token or user details.
                exit($e->getMessage());

            }

            //Use access token to get user info
            if (isset($accessToken)) {
                $resourceOwner = $this->provider->getResourceOwner($accessToken);
                $userInfo = $resourceOwner->toArray();

                $oldUser = User::query()->whereEmail($userInfo['email'])->first();
                if (!empty($oldUser)) { // for production apps add more checks to prevent possible account hijack.
                    $oldUser->oauth_uid = $userInfo['sub'];
                    $oldUser->save();
                    Auth::guard('web')->login($oldUser);
                } else {
                    $user = User::create([
                        'name' => $userInfo['email'],
                        'email' => $userInfo['email'],
                        'oauth_uid' => $userInfo['sub'],
                        'password' => Hash::make($userInfo['sub'] ."-". $userInfo['email'])
                    ]);

                    Auth::guard('web')->login($user);
                }

// Redirect user to a protected route
                return redirect('/dashboard');
            }
        }
    }
}
