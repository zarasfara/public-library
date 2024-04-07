<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Enums\RoleEnum;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (! is_null($user) && ($user->hasRole(RoleEnum::ADMINISTRATOR)
                || $user->hasRole(RoleEnum::LIBRARIAN)
                || $user->hasRole(RoleEnum::SECRETARY))) {
            return $next($request);
        }

        abort(Response::HTTP_FORBIDDEN, Response::$statusTexts[Response::HTTP_FORBIDDEN]);
    }
}
