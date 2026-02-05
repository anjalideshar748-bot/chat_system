<x-default-page>

    @foreach ($user as $user)
        <div class=" flex row-auto gap-4 px-3 py-3 rounded-lg bg-gray-50 hover:bg-[#95f6d1] cursor-pointer">
            <img src="https://i.pravatar.cc/40?img=32" class="rounded-full">
            <p class="font-semibold">{{ $user->name }}</p>
            <form method="POST"
                action="{{ Route('friend.request.accept', ['friend_id' => Auth::user()->id, 'user_id' => $user->id]) }}">
                @csrf
                <button
                    class="text-xs bg-white text-[#2f7f5f] px-2 py-1 rounded hover:bg-gray-200 mx-4 mb-2 "
                    onclick="return confirm('Are you sure you want to accept the friend request from {{ $user->name }}?');">
                    Accept
                </button>
            </form>
        </div>
    @endforeach

</x-default-page>
