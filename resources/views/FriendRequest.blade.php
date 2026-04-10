<x-default-page>

    @foreach ($user as $user)
        <div class="flex row-auto gap-4 px-4 py-3 rounded-lg bg-white border border-teal-100 shadow-sm items-center hover:shadow-md transition cursor-default">
            <div class="relative">
                <img src="{{ $user->profile_photo_url ?? 'https://i.pravatar.cc/40?img=' . rand(1, 70) }}" class="w-11 h-11 rounded-full object-cover">
                <span class="absolute bottom-0 right-0 w-3 h-3 rounded-full ring-2 ring-white {{ $user->is_online ? 'bg-emerald-500 status-pulse' : 'bg-gray-400' }}"></span>
            </div>
            <div class="flex-1">
                <p class="font-semibold text-gray-800">{{ $user->name }}</p>
                <p class="text-xs {{ $user->is_online ? 'text-emerald-600' : 'text-gray-500' }} mt-0.5">{{ $user->is_online ? '● Online' : 'Offline' }}</p>
            </div>
            <form method="POST"
                action="{{ Route('friend.request.accept', ['friend_id' => Auth::user()->id, 'user_id' => $user->id]) }}">
                @csrf
                <button
                    class="text-sm bg-gradient-to-r from-teal-600 to-emerald-600 text-white px-5 py-2 rounded-full hover:from-teal-700 hover:to-emerald-700 transition shadow-sm shadow-teal-500/30 flex items-center gap-2"
                    onclick="return confirm('Are you sure you want to accept the friend request from {{ $user->name }}?');">
                    <i class="fas fa-check"></i> Accept
                </button>
            </form>
            <form method="POST" action="{{ Route('friend.request.reject', ['friend_id' => $user->id]) }}">
                @csrf
                <button
                    class="text-sm bg-gradient-to-r from-gray-400 to-gray-500 text-white px-5 py-2 rounded-full hover:from-gray-500 hover:to-gray-600 transition shadow-sm shadow-gray-400/30 flex items-center gap-2"
                    onclick="return confirm('Are you sure you want to reject the friend request from {{ $user->name }}?');">
                    <i class="fas fa-times"></i> Reject
                </button>
            </form>
        </div>
    @endforeach

</x-default-page>
