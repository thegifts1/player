<?php

namespace App\Http\Controllers;

use App\Models\Music;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;

class MusicController extends Controller
{
    public function index()
    {
        $songs = 0;
        $counter = 0;

        $user = new User;
        if (isset($user['name'])) {
            $user->name = Auth::user()->name;

            $songs_db = Music::query()->get(['name', 'track_name', 'duration']);
            $count = count($songs_db);

            for ($i = 0; $i < $count; $i++) {
                if (isset($songs_db[$i])) {
                    if ($user['name'] == $songs_db[$i]['name']) {
                        $songs[$i]['track_name'] = $songs_db[$i]['track_name'];
                        $songs[$i]['duration'] = $songs_db[$i]['duration'];
                        $counter++;
                    }
                }
            }
            array_unshift($songs, 0);
        }

        return view('music.index', compact('songs', 'counter'));
    }
}