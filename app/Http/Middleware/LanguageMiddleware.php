<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class LanguageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // retrieve selected language from the language cookie
        $lang = $request->cookie('language');
        if (!empty($lang)) {
            App::setLocale($lang);
        }else{
            $l = 'en';
            if(strlen($request->header('accept-language')) > 1){
                $l = substr($request->header('accept-language'), 0, 2);
            }
            App::setLocale($l);
        }

        $tz = $request->cookie('timezone');
        if (!empty($tz)) {
            date_default_timezone_set($tz);
        }else{
            date_default_timezone_set('Europe/Riga');
        }
        return $next($request);
    }
}
