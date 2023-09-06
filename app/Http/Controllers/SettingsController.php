<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function index()
    {
        return view('settings.index');
    }

    public function changeThemeNotAuth(Request $request)
    {
        $guest_ip = $_SERVER['REMOTE_ADDR'];

        if (isset($request['darkTheme'])) {
            Guest::query()->where('ip_adress', "$guest_ip")->update(['darkTheme' => 1]);
        } else if (isset($request['lightTheme'])) {
            Guest::query()->where('ip_adress', "$guest_ip")->update(['darkTheme' => 0]);
        } else {
            return redirect()->back()->withErrors('Something went wrong');
        }

        return redirect()->back();
    }

    public function changeThemeForAuth(Request $request)
    {
        $user = new User;
        $user = Auth::user();

        if (isset($request['darkTheme'])) {
            User::query()->where('id', $user['id'])->update(['darkTheme' => 1]);
        } else {
            User::query()->where('id', $user['id'])->update(['darkTheme' => 0]);
        }

        return redirect()->back();
    }

    public function changeLangNotAuth(Request $request)
    {
        $guest_ip = $_SERVER['REMOTE_ADDR'];

        if ($request['lang'] == 'Rus') {
            Guest::query()->where('ip_adress', "$guest_ip")->update(['lang' => 'ru']);
        } else if ($request['lang'] == 'Eng') {
            Guest::query()->where('ip_adress', "$guest_ip")->update(['lang' => 'en']);
        }

        return redirect()->back();
    }

    public function changeLangForAuth(Request $request)
    {
        $user = new User;
        $user = Auth::user();
        
        if ($request['lang'] == 'Rus') {
            User::query()->where('id', $user['id'])->update(['lang' => 'ru']);
        } else if ($request['lang'] == 'Eng') {
            User::query()->where('id', $user['id'])->update(['lang' => 'en']);
        }

        return redirect()->back();
    }
}