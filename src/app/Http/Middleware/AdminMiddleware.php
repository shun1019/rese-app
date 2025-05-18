<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check() || !Auth::use()->isAdmin()) {
            abort(403, '管理者のみがアクセス可能です。');
        }

        return $next($request);
    }
}
