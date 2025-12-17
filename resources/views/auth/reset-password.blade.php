<x-welcome>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <label class="block mb-2 text-sm text-white">Email</label>
            <input type="text" name="email" placeholder="Enter your email address" :value="old('email', $request->email)"
                class="w-full px-4 py-3 rounded-full bg-green-700 text-white placeholder-green-300 focus:outline-none focus:ring-2 focus:ring-green-300 transition duration-300 hover:bg-green-600" />
            {{-- <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" /> --}}
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label class="block mb-2 text-sm text-white">Password</label>
            {{-- <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" /> --}}
             <input type="password" name="password" placeholder="Enter your password" :value="old('password', $request->password)"
                class="w-full px-4 py-3 rounded-full bg-green-700 text-white placeholder-green-300 focus:outline-none focus:ring-2 focus:ring-green-300 transition duration-300 hover:bg-green-600" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <label class="block mb-2 text-sm text-white">Confirm Password</label>

            <input type="password" name="password_confirmation" placeholder="Confirm your password" :value="old('password_confirmation', $request->password_confirmation)"
                class="w-full px-4 py-3 rounded-full bg-green-700 text-white placeholder-green-300 focus:outline-none focus:ring-2 focus:ring-green-300 transition duration-300 hover:bg-green-600" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
                        <button
                            class="w-full py-3 rounded-full bg-teal-400 text-green-900 font-semibold
                 hover:bg-teal-300 hover:shadow-lg hover:scale-[1.02]
                 active:scale-95 transition duration-300">Email
                            Reset Password</button>
                    </div>
    </form>
</x-welcome>z
