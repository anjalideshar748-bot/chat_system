<?php

namespace App\Http\Controllers;

use App\Models\friend;
use Illuminate\Http\Request;

class userController extends Controller
{
    //send friend request
    public function FriendRequest($user_id, $friend_id){
        if(friend::where('user_id',$user_id)->where('friend_id',$friend_id)->exists()){
            return back()->with('error','Friend request already sent');
        }if($user_id==$friend_id){
            return back()->with('error','You cannot send friend request to yourself');
        }


        $friend=new friend();
        $friend->user_id=$user_id;
        $friend->friend_id=$friend_id;
        $friend->status='pending';
        $friend->save();
        return back();
    }
    

}
