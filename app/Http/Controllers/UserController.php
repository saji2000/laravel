<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function logout(){
        auth()->logout();
        return redirect('/');
    }

    public function login(Request $request){
        $incomingFields = $request->validate([
            'loginname' => ['required', 'min:3', 'max:50'],
            'loginpassword' => ['required', 'string', 'min:3', 'max:30']
        ]);

        if (auth()->attempt(['name' => $incomingFields['loginname'], 'password' => $incomingFields['loginpassword']])){
            $request->session()->regenerate();
            return redirect('/')->with('success', 'Logged in!');
        }
        return redirect('/')->with('error', 'Login failed!');
    }

    public function register(Request $request){
        $incomingFields = $request->validate([
            'name' => ['required', 'min:3', 'max:50', Rule::unique('users', 'name')],
            'email' => ['required', 'email', 'max:80', Rule::unique('users', 'email')],
            'password' => ['required', 'string', 'min:3', 'max:30']
        ]);

        $incomingFields['password'] = bcrypt($incomingFields['password']);

        $user = User::create($incomingFields);

        auth()->login($user);

        return redirect('/');
    }
}
