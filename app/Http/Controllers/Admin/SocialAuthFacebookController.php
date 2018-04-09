<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use SammyK\LaravelFacebookSdk\LaravelFacebookSdk;
use Facebook\Exceptions\FacebookSDKException;

class SocialAuthFacebookController extends Controller
{
    /**
    * Create a redirect method to facebook api.
    *
    * @return void
    */
    public function redirect(LaravelFacebookSdk $fb)
    {
        $login_link = $fb->getLoginUrl();
        return redirect()->to($login_link);
    }

    /**
     * Return a callback method from facebook api.
     *
     * @return callback URL from facebook
     */
    public function callback(LaravelFacebookSdk $fb)
    {
        try {
            $token = $fb->getAccessTokenFromRedirect();
        } catch (FacebookSDKException $e) {
            // Failed to obtain access token
            dd($e->getMessage());
        }
    }
}
