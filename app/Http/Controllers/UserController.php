<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(Request $request){
        $incomingFields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string|min:8'
        ]);
        return 'Hello from Controller';
    }
}
