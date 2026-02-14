<x-default-page>

    @foreach ($user as $friendUser)
        <a href="{{ route('chat.show', $friendUser->id) }}"
           class="flex items-center gap-4 px-3 py-3 rounded-lg
                  bg-gray-50 hover:bg-[#95f6d1] transition">

            <img src="https://i.pravatar.cc/40?img=32"
                 class="w-10 h-10 rounded-full">

            <p class="font-semibold">
                {{ $friendUser->name }}
            </p>

        </a>
    @endforeach

</x-default-page>
