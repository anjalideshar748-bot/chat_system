<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\FriendshipController;


Route::get('/', function () {
    return view('welcome');
});




Route::middleware('auth')->group(function () {
    //for dashboard
Route::get('/dashboard', function () {
    $user = User::all();
    return view('dashboard',compact('user'));
})->middleware(['auth', 'verified'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/search_user',[ProfileController::class,'search_user'])->name('search_user');
});

require __DIR__.'/auth.php';
 // routes/web.php

Route::middleware('auth')->group(function () {
    Route::post('/friend-request/send/{id}', [FriendshipController::class, 'send']);
    Route::post('/friend-request/accept/{id}', [FriendshipController::class, 'accept']);
});

