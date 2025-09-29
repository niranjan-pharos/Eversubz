<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Website\MainController;

Route::get('main/index', [MainController::class, 'index'])->name('main.index');
Route::get('main/events', [MainController::class, 'events_index'])->name('main.events_index');
Route::get('main/events-details/{slug}', [MainController::class, 'events_details'])->name('main.events_details');
// Route::post('main/events-enquiry', [MainController::class, 'events_enquiry'])->name('events_enquiry');
// Route::post('/events/{event}/update-count', [MainController::class, 'updateCount']);

// Details Page
Route::post('events/{event}/markInterested', [MainController::class, 'markInterested'])->name('events.markInterested');
Route::post('events/{event}/unmarkInterested', [MainController::class, 'unmarkInterested'])->name('events.unmarkInterested');
Route::post('events/{event}/markGoing', [MainController::class, 'markGoing'])->name('events.markGoing');
Route::post('events/{event}/unmarkGoing', [MainController::class, 'unmarkGoing'])->name('events.unmarkGoing');
Route::post('/book-tickets', [MainController::class, 'bookTickets'])->name('book.tickets');
Route::get('payment/status', [MainController::class, 'getPaymentStatus'])->name('payment.status');

Route::middleware('auth')->group(function () {
    Route::post('/save', [MainController::class, 'saveEvent'])->name('action.save');
    Route::post('/remove', [MainController::class, 'remove'])->name('action.remove');
    Route::post('/add-to-page', [MainController::class, 'addToPage'])->name('action.addToPage');
    Route::post('/add-to-calendar', [MainController::class, 'addToCalendar'])->name('action.addToCalendar');
    Route::post('/share-profile', [MainController::class, 'shareProfile'])->name('action.shareProfile');
    Route::post('/report-event', [MainController::class, 'reportEvent'])->name('action.reportEvent');
});






  