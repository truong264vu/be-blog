<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{
    public function register(RegisterRequest $request){
        $user = new User;
        $user->fill($request->all());
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json($user);
    }

    public function login(LoginRequest $request){
        if(Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])){
            $user = User::whereEmail($request->email)->first();
            $user->token = $user->createToken('App')->accessToken; //tao token
            return response()->json($user);
        }

        return response()->json($user);
    }

    public function userInfo(Request $request) {
        return response()->json($request->user('api'));
    }

    public function updateAvatar(Request $request){ // thay avatar user
        $avatar = User::query()->find($request->idUser);
        $avatar->update(['avatar' => $request->avatar]);
        $avatar->save();
        return response()->json($avatar);

    }
}
