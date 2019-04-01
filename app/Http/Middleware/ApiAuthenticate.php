<?php

namespace App\Http\Middleware;

use App\Library\Utils\ApiCode;
use App\Library\Utils\Test;
use Closure;
use Illuminate\Support\Facades\Response;


class ApiAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $userId = user_id();
        if (!$userId) {
            return Response::json(api_error(ApiCode::AUTH_ERROR));
        }

        return $next($request);
    }
}
