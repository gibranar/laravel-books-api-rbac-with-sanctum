<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Utils\JSendFormatter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    protected $data = [];
    public function login(Request $request) 
    {
        $credentials = $request->only('email', 'password');

        if (!auth()->attempt($credentials)) {
            return JSendFormatter::fail('Wrong Username or Password!', null, 401);
        }

        $user = auth()->user()->makeHidden('roles');
        
        $this->data['token'] = $user->createToken('authToken')->plainTextToken;
        $this->data['user'] = $user;
        $this->data['role'] = $user->getRoleNames();

        return JSendFormatter::success('Login Success', $this->data, 200);
    }
    
    public function register(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return JSendFormatter::fail($validator->errors(), null, 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('viewer');

        $this->data['user'] = $user;

        return JSendFormatter::success('Account created successfully', $this->data, 201);
    }
}
