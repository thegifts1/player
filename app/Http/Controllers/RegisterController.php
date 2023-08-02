<?php

namespace App\Http\Controllers;

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
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:50', 'unique:users'],
            'email' => ['required', 'string', 'max:50', 'email', 'unique:users'],
            'password' => ['required', 'string', 'min:7', 'max:200', 'confirmed'],
        ]);

        $user = User::query()->create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
        ]);

        if (!is_dir('../storage/app/UsersMusic/')) {
            mkdir('../storage/app/UsersMusic/');
        }

        mkdir('../storage/app/UsersMusic/' . $user['name']);

        if (Auth::attempt($validated)) {
            $request->session()->regenerate();

            return redirect()->route('home.index');
        }

        // $user = new User;
        // $user->name = $validated['name'];
        // $user->email = $validated['email'];
        // $user->password = $validated['password'];
        // $user->save();

        return redirect()->route('register.index')->withErrors('Something went wrong');
    }
}