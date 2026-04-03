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
                        <a href="{{ route('chat.show', $user->id) }}" class="flex row-auto gap-4 px-3 py-3 rounded-lg bg-gray-50 hover:bg-[#95f6d1] cursor-pointer items-center">
                            <div class="relative">
                                <img src="https://i.pravatar.cc/40?img={{ rand(1, 70) }}" class="w-10 h-10 rounded-full">
                                <span class="absolute bottom-0 right-0 w-3 h-3 rounded-full ring-2 ring-white {{ $user->is_online ? 'bg-emerald-500 status-pulse' : 'bg-gray-400' }}"></span>
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold">{{ $user->name }}</p>
                                <p class="text-xs {{ $user->is_online ? 'text-emerald-600' : 'text-gray-500' }}">{{ $user->is_online ? '● Online' : 'Offline' }}</p>
                            </div>
                            <div class="text-sm text-teal-700 bg-teal-100/50 px-3 py-1 rounded-full font-medium flex items-center gap-2 hover:bg-teal-200 transition">
                                <i class="fas fa-comment-dots"></i> Message
                            </div>
                        </a>
                        {{-- if friend pending --}}
                        @else
                        <div class="flex row-auto gap-4 px-3 py-3 rounded-lg bg-gray-50 items-center">
                            <div class="relative">
                                <img src="https://i.pravatar.cc/40?img=32" class="w-10 h-10 rounded-full">
                                <span class="absolute bottom-0 right-0 w-3 h-3 rounded-full ring-2 ring-white {{ $user->is_online ? 'bg-emerald-500' : 'bg-gray-400' }}"></span>
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold">{{ $user->name }}</p>
                                <p class="text-xs {{ $user->is_online ? 'text-emerald-600' : 'text-gray-500' }}">{{ $user->is_online ? '● Online' : 'Offline' }}</p>
                            </div>
                            <div class="text-xs text-orange-600 bg-orange-50 px-3 py-1 rounded-full border border-orange-100">Request Sent</div>
                        </div>
                        @endif
                    {{-- if friend not exist --}}
                    @else
                        @if($user->id != Auth::user()->id)
                        <div class="flex row-auto gap-4 px-3 py-3 rounded-lg bg-gray-50 items-center">
                            <div class="relative">
                                <img src="https://i.pravatar.cc/40?img=32" class="w-10 h-10 rounded-full">
                                <span class="absolute bottom-0 right-0 w-3 h-3 rounded-full ring-2 ring-white {{ $user->is_online ? 'bg-emerald-500' : 'bg-gray-400' }}"></span>
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold">{{ $user->name }}</p>
                                <p class="text-xs {{ $user->is_online ? 'text-emerald-600' : 'text-gray-500' }}">{{ $user->is_online ? '● Online' : 'Offline' }}</p>
                            </div>
                            <form method="POST"
                                    action="{{ Route('friend.request.send', ['user_id' => Auth::user()->id, 'friend_id' => $user->id]) }}">
                                    @csrf
                                    <button
                                        class="text-xs bg-teal-600 text-white px-4 py-1.5 rounded-full hover:bg-teal-700 transition shadow-sm"
                                        onclick="return confirm('Are you sure you want to send a friend request to {{ $user->name }}?');">
                                        Add Friend
                                    </button>
                            </form>
                        </div>
                        @else
                        <div class="flex row-auto gap-4 px-3 py-3 rounded-lg bg-teal-50 items-center border border-teal-100 shadow-sm">
                            <div class="relative">
                                <img src="https://i.pravatar.cc/40?img=32" class="w-10 h-10 rounded-full">
                                <span class="absolute bottom-0 right-0 w-3 h-3 rounded-full ring-2 ring-white bg-emerald-500 status-pulse"></span>
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold text-teal-900">{{ $user->name }} <span class="text-teal-600 text-xs ml-1">(You)</span></p>
                                <p class="text-xs text-emerald-600">● Online</p>
                            </div>
                        </div>
                        @endif
                    @endif
                @endforeach

            </div>


</x-default-page>
