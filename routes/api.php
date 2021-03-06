<?php

use App\Http\Controllers\BookingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/* GetAvailableSeat
|  {from}: start station id
|  {to}: end station id
*/
Route::get('available-seats/{from}/{to}', [BookingController::class, 'getAvailableSeats']);

/* BookSeat
|  {from_station}: start station id
|  {to_station}: end station id
|  {user_id}: user id
*/
Route::post('book-seat', [BookingController::class, 'bookSeat']);
