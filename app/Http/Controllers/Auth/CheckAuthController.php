<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class CheckAuthController extends Controller
{
    public function check(): JsonResponse
    {
        if (Auth::check()) {
            return response()->json(['isLoggedIn' => true],200);
        }

        return response()->json(['isLoggedIn' => false], 200);
    }
}
