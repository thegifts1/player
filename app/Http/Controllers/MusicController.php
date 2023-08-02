<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class MusicController extends Controller
{
    public function index()
    {
        return view('music.index');
    }
}