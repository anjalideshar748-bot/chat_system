<x-default-page > {{-- or your layout component name --}}

    <h2 class="text-xl font-semibold mb-4 text-[#3c8c6d]">
        Friend Requests
    </h2>

    @forelse ($requests as $user)
        <div class="flex items-center justify-between p-4 bg-white rounded-xl shadow">
            <div class="flex items-center gap-3">
                <img src="https://i.pravatar.cc/40?img={{ $user->id }}" class="rounded-full">
                <p class="font-semibold">{{ $user->name }}</p>
            </div>

            <form method="POST" action="{{ route('friend.accept', $user->id) }}">
                @csrf
                <button
                    class="px-4 py-2 text-sm rounded-full
                           bg-emerald-500 text-white
                           hover:bg-emerald-600 transition">
                    Accept
                </button>
            </form>
        </div>
    @empty
        <p class="text-gray-500 text-center">No friend requests</p>
    @endforelse

    </x-default-page>
