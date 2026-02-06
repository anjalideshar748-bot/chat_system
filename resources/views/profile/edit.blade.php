<x-default-page>
    <div class="max-w-2xl mx-auto p-4 bg-white shadow-md rounded-lg">
        <h2 class="text-2xl font-semibold mb-4">Profile Information</h2>

        <div class="flex items-center mb-4">
            <img src="https://i.pravatar.cc/100?img={{ Auth::user()->id }}" alt="Profile Picture" class="w-24 h-24 rounded-full mr-4">
            <div>
                <h3 class="text-xl font-bold">{{ Auth::user()->name }}</h3>
                <p class="text-gray-600">{{ Auth::user()->email }}</p>
            </div>
        </div>

        <div class="mt-6">
            <h4 class="text-lg font-semibold mb-2">About Me</h4>
            <p class="text-gray-700">This is a placeholder for additional profile information. You can add more details about the user here.</p>
        </div>
    </div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-default-page>
