<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\userController;
use App\Models\friend;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});




Route::middleware('auth')->group(function () {
    //for dashboard
Route::get('/dashboard', function () {
    $friend = friend::where('status','accepted')->get();
    $user=$friend->map(function($friend){
        if($friend->user_id == Auth::id()){
            return User::find($friend->friend_id);
        }else{
            return User::find($friend->user_id);
        }
    });

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
    Route::post('/friend-request/send/{user_id}{friend_id}', [userController::class, 'FriendRequest'])->name('friend.request.send');
    Route::post('/friend-request/accept/{friend_id}', [userController::class, 'accept'])->name('friend.request.accept');
});

