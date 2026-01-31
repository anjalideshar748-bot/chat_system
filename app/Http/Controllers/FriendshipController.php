<?php

// app/Http/Controllers/FriendshipController.php
namespace App\Http\Controllers;

use App\Models\Friendship;
use Illuminate\Support\Facades\Auth;

class FriendshipController extends Controller
{
    // SEND REQUEST
    public function send($friendId)
    {
        if ($friendId == Auth::id()) {
            return back();
        }

        Friendship::firstOrCreate([
            'user_id' => Auth::id(),
            'friend_id' => $friendId
        ]);

        return back()->with('success', 'Friend request sent');
    }

    // ACCEPT REQUEST
    public function accept($id)
    {
        $request = Friendship::where('id', $id)
            ->where('friend_id', Auth::id())
            ->firstOrFail();

        // Update sender → receiver
        $request->update(['status' => 'accepted']);

        // Create reverse record (important for chat)
        Friendship::create([
            'user_id' => Auth::id(),
            'friend_id' => $request->user_id,
            'status' => 'accepted'
        ]);

        return back()->with('success', 'You are now friends');
    }
}
