<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\UserBusinessInfos;

class CheckBusinessProductCreation
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'You need to login first.');
        }

        $businessInfo = UserBusinessInfos::where('user_id', $user->id)->first();

        if ($user->is_admin_approved != 1 || !$businessInfo || empty($businessInfo->business_name)) {
            return redirect()->back()->with('error', 'You need to set your business name and wait for admin approval.');
        }

        return $next($request);
    }
}
