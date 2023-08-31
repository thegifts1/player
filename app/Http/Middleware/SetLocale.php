<?php

namespace App\Http\Middleware;

use App\Models\Guest;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = new User;
        $user = Auth::user();

        if (isset($user)) {
            App::setLocale($user['lang']);

            return $next($request);
        } else {
            $guests = Guest::query()->get(['ip_adress', 'lang']);

            foreach ($guests as $guest) {
                if ($guest['ip_adress'] == $_SERVER['REMOTE_ADDR']) {
                    App::setLocale($guest['lang']);

                    return $next($request);
                }
            }
            
            Guest::query()->create([
                'ip_adress' => $_SERVER['REMOTE_ADDR'],
            ]);
        }

        return $next($request);
    }
}