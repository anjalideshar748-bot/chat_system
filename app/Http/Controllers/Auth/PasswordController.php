<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Support\PasswordHmac;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $storedPassword = (string) $request->user()->password;
        $currentPassword = (string) $validated['current_password'];
        $matchesHmac = Hash::check(PasswordHmac::transform($currentPassword), $storedPassword);
        $matchesLegacy = Hash::check($currentPassword, $storedPassword);

        if (! $matchesHmac && ! $matchesLegacy) {
            return back()
                ->withErrors(['current_password' => __('auth.password')], 'updatePassword');
        }

        $request->user()->update([
            'password' => Hash::make(PasswordHmac::transform($validated['password'])),
        ]);

        return back()->with('status', 'password-updated');
    }
}
