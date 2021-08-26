<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    
    // public function store(Request $request)
        // {
        //     // $request->validate([
        //     //     'name' => 'required|string|max:255',
        //     //     'email' => 'required|string|email|max:255|unique:users',
        //     //     'password' => ['required', 'confirmed', Rules\Password::defaults()],
        //     // ]);

        //     $user = User::create([
        //         'name' => $request->name,
        //         'email' => $request->email,
        //         'password' => Hash::make($request->password),
        //     ]);

        //     $user->attachRole('administrator');

        //     event(new Registered($user));

        //     Auth::login($user);

        //     return ['message' => 'Account Created']; // API

        //     return view(RouteServiceProvider::HOME);
    // }

    public function store(Request $request){ // Register For an api
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string'
        ]);
        
        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt( $fields['password']) 
        ]);

        $token = $user->createToken('myappToken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token,
        ];

        // return view(RouteServiceProvider::HOME); 
        return response($response, 201);
    }
}
