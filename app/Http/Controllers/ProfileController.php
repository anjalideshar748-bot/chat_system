<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use App\Models\friend;


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    public function search_user(Request $request){
        $search = $request->get('search');
        $user = User::where('name','like',"%$search%")->get();
        $friend = friend::where('user_id',Auth::user()->id)->orWhere('friend_id',Auth::user()->id)->get();


        return view('Search_dashboard', compact('user','friend'));
    }
    public function accept($id)
    {
        $user_id = Auth::id();

        // Update existing pending request
        Friend::where('user_id', $id)
              ->where('friend_id', $user_id)
              ->where('status', 'pending')
              ->update(['status' => 'accepted']);

        return back()->with('success', 'Friend request accepted');
    }


}

