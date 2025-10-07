<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(Request $request){
        $incomingFields = $request->validate([
            'name' => ['required', 'min:3', 'max:50'],
            'email' => ['required', 'email', 'max:80'],
            'password' => ['required', 'string', 'min:8', 'max:30']
        ]);
        return 'Hello from Controller';
    }
}
