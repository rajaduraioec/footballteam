<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\BaseController;
use App\Http\Requests\LoginRequest;

class LoginController extends BaseController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request)
    {
        $validated = $request->validated();

        if(Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']])){ 

            $user = Auth::user(); 
            $data['token'] =  $user->createToken('LeaseWeb')->plainTextToken; 
            $data['name'] =  $user->name;
   
            return $this->sendResponse($data, 'User logged in successfully.');
        } 
        else{ 

            return $this->sendError('Unauthorized.', ['error'=>'Invalid Credentials']);
        } 
    }
}
