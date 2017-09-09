<?php

namespace CodeDelivery\Http\Controllers\Api;

use Illuminate\Http\Request;
use CodeDelivery\Http\Requests\ApiRegisterRequest;
use CodeDelivery\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use CodeDelivery\Models\User;
use Response;

class UserController extends Controller
{
    public function __contructor(){
        $this->content = array();
    }

    public function login(){
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $this->content['token'] =  $user->createToken('Delivery App')->accessToken;
            $status = 200;
        }
        else{
            $this->content['error'] = "Unauthorised";
            $status = 401;
        }

        return response()->json($this->content, $status);
    }

    public function register(ApiRegisterRequest $request)
    {
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;

        $status = 200;
        return response()->json(['success'=>$success], $status);
    }

    public function details()
    {
        $user = Auth::user();
        $status = 200;
        return response()->json(['success' => $user], $status);
    }
}
