<?php

    use App\Http\Controllers\AnalyticController;
    use App\Http\Controllers\ChatController;
    use App\Http\Controllers\DashboardController;
    use App\Http\Controllers\PostController;
    use App\Http\Controllers\ProfileController;
    use App\Http\Controllers\QueueEmails;
    use App\Http\Controllers\UsersController;
    use Illuminate\Foundation\Application;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Route;
    use Inertia\Inertia;

    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | contains the "web" middleware group. Now create something great!
    |
    */

    //use midleware 'blockIP'

    Route::get('/', function () {
        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
//            'laravelVersion' => Application::VERSION,
//            'phpVersion' => PHP_VERSION,
        ]);
    })->middleware(['blockIP']);

    //Refacotr to dashboard controller
//    Route::get('/dashboard', function () {
//        return Inertia::render('Dashboard');
//    })->middleware(['auth', 'verified','blockIP'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified','blockIP'])->name('dashboard');

    Route::middleware(['auth','blockIP'])->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::get('/analytic', [AnalyticController::class, 'index'])->name('analytic.index');

        //route for users
        Route::get('/users', [UsersController::class, 'index'])->name('users.index');
        //route for chat
        Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
        //message send
        Route::post('/chat', [ChatController::class, 'send'])->name('chat.send');

        Route::get('sending-queue-emails', [QueueEmails::class,'sendTestEmails']);


    });

    require __DIR__ . '/auth.php';
