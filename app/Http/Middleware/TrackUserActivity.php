<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\UserActivity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TrackUserActivity
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            try {
                // Log untuk debugging
                Log::info('User accessing page:', [
                    'user_id' => Auth::id(),
                    'path' => $request->path(),
                    'method' => $request->method()
                ]);

                // Catat aktivitas
                UserActivity::create([
                    'user_id' => Auth::id(),
                    'activity_type' => $this->getActivityType($request),
                    'page_accessed' => $request->path(),
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'login_at' => $request->is('login') ? now() : null
                ]);

            } catch (\Exception $e) {
                Log::error('Error tracking user activity:', [
                    'error' => $e->getMessage(),
                    'user_id' => Auth::id()
                ]);
            }
        }

        return $next($request);
    }

    private function getActivityType($request)
    {
        if ($request->is('login'))
            return 'Login';
        if ($request->is('logout'))
            return 'Logout';

        switch ($request->method()) {
            case 'POST':
                return 'Create';
            case 'PUT':
            case 'PATCH':
                return 'Update';
            case 'DELETE':
                return 'Delete';
            default:
                return 'View';
        }
    }
}