<?php

    use App\Http\Controllers\AnalyticController as AnalyticControllerAlias;
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

    Route::middleware(['auth:sanctum', 'blockIP'])->get('/user', function (Request $request) {
        return $request->user();
    });

    //group auth:sanctum
    Route::get('/analytic/logs', [AnalyticControllerAlias::class, 'getLogs'])->middleware(['blockIP'])->name('analytic.logs');
