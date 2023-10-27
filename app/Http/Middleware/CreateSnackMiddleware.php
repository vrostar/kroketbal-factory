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
        $user = $request->user(); // Get the authenticated user
        $viewedSnacks = $user->snackViews->count(); // Assuming you have a relationship to snackViews

        if ($viewedSnacks >= 4) {
            return $next($request); // User has viewed at least 4 snacks, allow access.
        }

        return redirect()->route('snacks.index')
            ->with('warning', 'You need to view at least 4 snacks to create a new snack.');

    }
}
