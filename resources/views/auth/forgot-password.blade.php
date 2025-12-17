<x-welcome>
    <div class="bg-green-800 p-10 flex items-center">
        <div class="w-full max-w-sm mx-auto text-white">
            <h2 class="text-1xl font-bold mb-8"> {{ __('Forgot your password? ') }}</h2>
            <h5 class="text-sm mb-8">
                {{ __('No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </h5>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <div class="mb-5">
                        <label class="block mb-2 text-sm text-white">Email</label>
                        <input type="text" name="email" placeholder="Enter your email address"
                            class="w-full px-4 py-3 rounded-full bg-green-700 text-white placeholder-green-300 focus:outline-none focus:ring-2 focus:ring-green-300 transition duration-300 hover:bg-green-600" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button
                            class="w-full py-3 rounded-full bg-teal-400 text-green-900 font-semibold
                 hover:bg-teal-300 hover:shadow-lg hover:scale-[1.02]
                 active:scale-95 transition duration-300">Email
                            Password Reset Link</button>
                    </div>
            </form>

</x-welcome>
