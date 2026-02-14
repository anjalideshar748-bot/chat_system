<?php

namespace App\Http\Controllers;

use App\Models\friend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;





class userController extends Controller
{
    //send friend request
    public function friendRequestView(){
        $friend = Friend::where('friend_id',Auth::User()->id)->where('status','pending')->get();
        $user = $friend->map(function($friend){
            return User::find($friend->user_id);

        });
        return view("FriendRequest",compact('friend','user'));
    }

    public function FriendRequestSend($user_id,$friend_id){
        $friend = new friend();
        $friend->user_id=$user_id;
        $friend->friend_id=$friend_id;
        $friend->status='pending';
        $friend->save();
        return redirect()->back()->with('success', 'Friend request sent');
    }

    // request accept
    public function requestAccept($friend_id, $user_id){
        $friend = Friend::where('friend_id',$friend_id)->where('user_id',$user_id)->first();
        $friend->status='accepted';
        $friend->save();
        return redirect()->back();

    }

    //chat area

    public function show($id)
{
    $user = User::findOrFail($id);

    return view('chat-area', compact('user'));
}





}
