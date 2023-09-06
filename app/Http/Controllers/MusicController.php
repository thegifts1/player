<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MusicController extends Controller
{
    public function index()
    {
        $songs = [];
        $counter = 0;

        $user = new User;
        $user = Auth::user();

        if (isset($user)) {
            $user->name = Auth::user()->name;

            $songs_db = DB::table('music')->where('name', $user['name'])->get(['track_name', 'duration']);
            $count = count($songs_db);

            for ($i = 0; $i < $count; $i++) {
                $songs[$i]['track_name'] = $songs_db[$i]->track_name;
                $songs[$i]['duration'] = $songs_db[$i]->duration;
                $counter++;
            }
            array_unshift($songs, 0);
        }

        return view('music.index', compact('songs', 'counter'));
    }
}
