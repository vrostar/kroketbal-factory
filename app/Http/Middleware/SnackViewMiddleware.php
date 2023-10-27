<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\SnackView;
use App\Http\Controllers\SnackController;


class SnackViewMiddleware
{
    public function handle($request, Closure $next)
    {
        // Check if the user is authenticated
        if (auth()->check()) {
            $user = auth()->user();
            $snack = $request->route('snack');

            $view = SnackView::where('user_id', $user->id)
                ->where('snack_id', $snack->id)
                ->first();

            if ($view) {
                // Update the timestamp for the existing view
                $view->update(['viewed_at' => now()]);
            } else {
                SnackView::create([
                    'user_id' => $user->id,
                    'snack_id' => $snack->id,
                    'viewed_at' => now(),
                ]);
            }

            // Check if the user has viewed four snacks
            $viewCount = SnackView::where('user_id', $user->id)->count();
            if ($viewCount >= 4 && $user->status !== 'verified') {
                $user->update(['status' => 'verified']);
            }
        }

        return $next($request);
    }

}
