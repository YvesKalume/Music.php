<?php

namespace App\Http\Controllers;

use GuzzleHttp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PasswordGrantController extends Controller
{
    /**
     * Check if the credentials provided by the client are valid and attach
     * the password grant client information if so.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request) {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $http = new GuzzleHttp\Client;

            $response = $http->post(env('APP_URL') . '/oauth/token', [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => env('PASSWORD_CLIENT_ID'),
                    'client_secret' => env('PASSWORD_CLIENT_SECRET'),
                    'username' => $request->email,
                    'password' => $request->password,
                    'scope' => '*'
                ],
            ]);

            return json_decode((string) $response->getBody(), true);
        }

    }
}
