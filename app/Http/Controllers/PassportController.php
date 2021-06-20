<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PassportController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request,[
            "name" =>"required|min:3",
            "email" => "required|mail|unique:users",
            'password' => 'required|min:6'
        ]);

        $user = User::create([
                        'name' => $request->name,
                        'email' => $request->email,
                        'password' => bcrypt($request->password)
                    ]);
        $token = $user->createToken("tutsForWeb")->accessToken;
        return response()->json(["token"=>$token]);
    }

    public function login(Request $request)
    {
        $this->validate($request,[
            'email'=>'required',
            'password'=>'required'
        ]);
        $crytential = [
            'email'=>$request->email,
            'password'=>$request->password
        ];
        if(auth()->attempt($crytential))
    }
}
