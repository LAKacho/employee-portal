<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
public function handle(Request $request, Closure $next): Response
{


if (!Auth::check()) {
    return response()->json(['message' => 'Вы не авторизованы'], 401,[], JSON_UNESCAPED_UNICODE);
}

$isAdmin = Auth::user()->is_admin;  

    if (!$isAdmin) {
        return response()->json(['message' => 'У вас нет прав'], 403,[], JSON_UNESCAPED_UNICODE);
    }

    return $next($request);
}       
}
