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

            // Retrieve the snack id number from the route
            $snack = $request->route('snack');

            // Check if user has already viewed snack
            $view = SnackView::where('user_id', $user->id)
                ->where('snack_id', $snack->id)
                ->first();

            if ($view) {
                // Update the viewed at timestamp in snack views table if snack has been viewed before
                $view->update(['viewed_at' => now()]);
            } else {
                // If first time viewing snack create new record in database
                SnackView::create([
                    'user_id' => $user->id,
                    'snack_id' => $snack->id,
                    'viewed_at' => now(),
                ]);
            }

            // Check if the user has viewed four snacks
            $viewCount = SnackView::where('user_id', $user->id)->count();
            // Give user verified status if 4 snacks have been viewed
            // Scrapped this idea !
            if ($viewCount >= 4 && $user->status !== 'verified') {
                $user->update(['status' => 'verified']);
            }
        }

        return $next($request);
    }

}
