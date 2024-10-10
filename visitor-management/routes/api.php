<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisitorController;
use Illuminate\Http\Request;
use App\Models\Visitor;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('visitors/check-in', [VisitorController::class, 'checkIn']);
Route::post('visitors/check-out', [VisitorController::class, 'checkOut']);
Route::get('/visitors', [VisitorController::class, 'index']);
