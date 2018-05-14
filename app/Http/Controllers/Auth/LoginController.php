<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client as GuzzleClient;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    
    /**
     * Issue user token via oauth protocol
     * @param Request $request
     * @return type
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6',
        ]);
        try{
            $http = new GuzzleClient;
            $response = $http->post(env('APP_URL') . '/oauth/token', [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => env('PASSWORD_CLIENT_ID'),
                    'client_secret' => env('PASSWORD_CLIENT_SECRET'),
                    'username' => $request->get('email'),
                    'password' => $request->get('password'),
                    'remember' => $request->get('remember'),
                    'scope' => '',
                ],
            ]);
            return json_decode((string)$response->getBody(), true);
        } catch (\Exception $e){
            return response()->json(['error' => 'invalid credentials'], 401);
        }
    }
    
    /**
     * Logout user
     * @param Request $request
     * @return type
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([], 204);
    }
}
