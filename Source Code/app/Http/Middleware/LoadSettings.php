<?php
namespace App\Http\Middleware;

use Closure;
use App\Models\Setting;

class LoadSettings
{
    public function handle($request, Closure $next)
    {
        $setting = Setting::first();
        view()->share('settings', $setting);

        return $next($request);
    }
}
