<x-default-page>

    @foreach ($user as $user)
        <a class=" flex row-auto gap-4 px-3 py-3 rounded-lg bg-gray-50 hover:bg-[#95f6d1] cursor-pointer">
            <img href="" src="https://i.pravatar.cc/40?img=32" class="rounded-full">
            <p class="font-semibold">{{ $user->name }}</p>
        </a>
    @endforeach

</x-default-page>
