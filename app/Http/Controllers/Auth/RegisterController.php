<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client as GuzzleClient;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    
    /**
     * Save new user to db. Issue user token via oauth protocol
     * @param Request $request
     * @return type
     */
    public function register(Request $request)
    {    
        $request->validate([
            'name' => 'required|min:3|regex:/^[a-zA-Z\-\s]+$/',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|regex:/^[0-9]{12}+$/',
            'password' => 'required|min:6',
            'c_password' => 'same:password'
        ]);

        try {
            $this->create($request->all());
            $http = new GuzzleClient;
            $response = $http->post(env('APP_URL') . '/oauth/token', [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => env('PASSWORD_CLIENT_ID'),
                    'client_secret' => env('PASSWORD_CLIENT_SECRET'),
                    'username' => $request->get('email'),
                    'password' => $request->get('password'),
                    'remember' => false,
                    'scope' => '',
                ],
            ]);
            return json_decode((string)$response->getBody(), true);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create($data);
    }
}
