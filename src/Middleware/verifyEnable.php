<?php

namespace WalkerChiu\SiteMall\Middleware;

use Closure;
use WalkerChiu\SiteMall\Models\Services\SiteService;

class verifyEnable
{
    /**
     * Creates a new instance of the middleware.
     *
     * @param Guard  $auth
     */
    public function __construct()
    {
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request  $request
     * @param Closure                   $next
     * @return Mixed
     */
    public function handle($request, Closure $next)
    {
        $service = new SiteService();

        if ($service->getSite()->is_enabled)
            return $next($request);

        abort(404);
    }
}
