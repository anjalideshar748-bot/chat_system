<x-default-page>
    @foreach ($user as $user)
                    <div class=" flex row-auto gap-4 px-3 py-3 rounded-lg bg-[#3c8c6d] cursor-pointer">

                        <img src="https://i.pravatar.cc/40?img=32" class="rounded-full">
                        <p class="font-semibold">{{ $user->name }}</p>

                    </div>
                @endforeach
</x-default-page>
