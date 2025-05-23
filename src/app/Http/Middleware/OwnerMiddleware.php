<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class OwnerMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check() || !Auth::user()->isOwner()) {
            abort(403, '店舗代表者のみがアクセス可能です。');
        }

        return $next($request);
    }
}
