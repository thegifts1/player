<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index');
    }

    public function store(Request $request)
    {   
        $guest_ip = $_SERVER['REMOTE_ADDR'];
        $guest = Guest::query()->where('ip_adress', "$guest_ip")->get();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:50', 'unique:users'],
            'email' => ['required', 'string', 'max:50', 'email', 'unique:users'],
            'password' => ['required', 'string', 'min:7', 'max:200', 'confirmed'],
        ]);
         
        User::query()->create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'lang' => $guest[0]['lang'],
            'darkTheme' => $guest[0]['darkTheme'],
        ]);

        if (isset($request['remember'])) {
            $remember = true;
        } else {
            $remember = false;
        }

        if (Auth::attempt($validated, $remember)) {
            $request->session()->regenerate();

            return redirect()->route('home.index');
        }

        return redirect()->route('register.index')->withErrors('Something went wrong');
    }
}