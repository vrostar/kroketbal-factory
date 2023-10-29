<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\SnackView;
use App\Models\User;

class CreateSnackMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get the authenticated user
        $user = $request->user();
        // Connect with snackViews to get user's viewed snack count
        $viewedSnacks = $user->snackViews->count();

        // If user has viewed 4 snacks or more, allow access.
        if ($viewedSnacks >= 4) {
            return $next($request);
        }

        return redirect()->route('snacks.index')
            ->with('warning', 'You need to view at least 4 snacks to create a new snack.');

    }
}
