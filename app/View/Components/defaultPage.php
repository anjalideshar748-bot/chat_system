<?php

namespace App\View\Components;

use App\Models\friend;
use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class defaultPage extends Component
{
    public $friends;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        if (Auth::check()) {
            $friendships = friend::where(function($query) {
                $query->where('user_id', Auth::id())
                      ->orWhere('friend_id', Auth::id());
            })->where('status', 'accepted')->get();

            $this->friends = $friendships->map(function($f) {
                if ($f->user_id == Auth::id()) {
                    return User::find($f->friend_id);
                } else {
                    return User::find($f->user_id);
                }
            })->filter(); // Remove nulls if a user was deleted
        } else {
            $this->friends = collect([]);
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.default-page');
    }
}
