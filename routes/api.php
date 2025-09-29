<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Website\TicketController;

use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/auth/status', function () {
    return response()->json(['is_logged_in' => Auth::check()]);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// protected route
// Route::middleware('auth:sanctum')->get('/api/tickets/{id}', [TicketController::class, 'getTicketInfo']);
// without protected route
Route::get('/api/tickets/{id}', [TicketController::class, 'getTicketInfo'])->name('shortTicket.url');



