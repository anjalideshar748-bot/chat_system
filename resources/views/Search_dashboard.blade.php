<x-default-page>
    {{-- @foreach ($user as $user)
        <a class=" flex row-auto gap-4 px-3 py-3 rounded-lg bg-gray-50 hover:bg-[#95f6d1] cursor-pointer">
            <img href="" src="https://i.pravatar.cc/40?img=32" class="rounded-full">
            <p class="font-semibold">{{ $user->name }}</p>
        </a>
    @endforeach --}}

<div class="flex-1 overflow-y-auto space-y-1 px-2">

                @foreach ($user as $user)
                    {{-- if friend exist --}}
                    @if($friend->contains('friend_id', $user->id))
                        {{-- if friend accepted --}}
                        @if($friend->where('friend_id', $user->id)->first()->status == 'accepted')
                        <div class=" flex row-auto gap-4 px-3 py-3 rounded-lg bg-gray-50 hover:bg-[#95f6d1] cursor-pointer">

                            <img src="https://i.pravatar.cc/40?img=32" class="rounded-full">
                            <p class="font-semibold">{{ $user->name }}</p>
                            <p>Friend</p>
                        </div>
                        {{-- if friend pending --}}
                        @else
                        <div class=" flex row-auto gap-4 px-3 py-3 rounded-lg bg-gray-50 hover:bg-[#95f6d1] cursor-pointer">

                            <img src="https://i.pravatar.cc/40?img=32" class="rounded-full">
                            <p class="font-semibold">{{ $user->name }}</p>
                            <p>request send</p>
                        </div>
                        @endif
                    {{-- if friend not exist --}}
                    @else
                        @if($user->id != Auth::user()->id)
                        <div class=" flex row-auto gap-4 px-3 py-3 rounded-lg bg-gray-50 hover:bg-[#95f6d1] cursor-pointer">
                            <img src="https://i.pravatar.cc/40?img=32" class="rounded-full">
                            <p class="font-semibold">{{ $user->name }}</p>
                            <form method="POST"
                                    action="{{ Route('friend.request.send', ['user_id' => Auth::user()->id, 'friend_id' => $user->id]) }}">
                                    @csrf
                                    <button
                                        class="text-xs bg-white text-[#2f7f5f] px-2 py-1 rounded hover:bg-gray-200 mx-4 mb-2 "
                                        onclick="return confirm('Are you sure you want to send a friend request to {{ $user->name }}?');">
                                        Add Friend
                                    </button>
                            </form>
                        </div>
                        @else
                        <div class=" flex row-auto gap-4 px-3 py-3 rounded-lg bg-gray-50 hover:bg-[#95f6d1] cursor-pointer">
                            <img src="https://i.pravatar.cc/40?img=32" class="rounded-full">
                            <p class="font-semibold">{{ $user->name }}</p>
                            <p class="">me</p>
                        </div>
                        @endif
                    @endif
                @endforeach

            </div>


</x-default-page>
