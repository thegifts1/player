<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function TestMail(Request $request)
    {
        Mail::to($request->user())->send(new TestMail);

        return view('home.index');
    }
}