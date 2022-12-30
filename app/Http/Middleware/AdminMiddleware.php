<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as HTTP_RESPONSE;
class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response|RedirectResponse) $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next): Response | RedirectResponse
    {
        if(!$request->user()->is_admin){
            abort(code: HTTP_RESPONSE::HTTP_FORBIDDEN,  message:'This action is unauthorized.');
        }
        return $next($request);
    }
}
