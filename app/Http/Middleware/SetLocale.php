<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $settingsPath = storage_path('app/settings.json');

        $locale = config('app.locale'); // язык по умолчанию из config/app.php

        if (File::exists($settingsPath)) {
            $settings = json_decode(File::get($settingsPath), true);
            if (isset($settings['locale']) && in_array($settings['locale'], ['ru', 'uz'])) {
                $locale = $settings['locale'];
            }
        }

        App::setLocale($locale);

        return $next($request);
    }
}
