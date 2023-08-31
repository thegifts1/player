<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'password' => ['required', 'string', 'min:7', 'max:200'],
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

        return redirect()->route('login.index')->withErrors('Something went wrong');
    }
}