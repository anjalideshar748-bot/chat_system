<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Chat UI</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="h-screen w-screen bg-[#1f6b4e] flex items-center justify-center">


    <!-- MAIN WRAPPER -->
    <div class="w-[95%] h-[95%] bg-white rounded-lg shadow-xl flex overflow-hidden">

        <!-- SIDEBAR -->
        <aside class="w-1/4 bg-[#2f7f5f] text-white flex flex-col">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="text-sm bg-white text-[#2f7f5f] px-3 py-1 rounded hover:bg-gray-200">
                    Logout
                </button>
            </form>


            <!-- Logo -->
            <div class="p-4 flex items-center justify-between border-b border-white/20">
                <a><h1 class="font-bold text-lg">talk</h1></a>

                <a>
                     <button class="bg-white text-[#2f7f5f] bold rounded-full w-10 h-10 hover:scale-110 transition">🕭</button></a>
            </div>

            <!-- Search -->

            <form method="get" action="{{ route('search_user') }}" class="p-4">
                <input type="text" name="search" placeholder="Search"
                    class="w-full px-4 py-2 rounded bg-[#3c8c6d] placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-white" />

            </form>







            <!-- Contacts -->
            <div class="flex-1 overflow-y-auto space-y-1 px-2">
                @foreach ($user as $user)
                    <div class=" flex row-auto gap-4 px-3 py-3 rounded-lg bg-[#3c8c6d] cursor-pointer">

                        <img src="https://i.pravatar.cc/40?img=32" class="rounded-full">
                        <p class="font-semibold">{{ $user->name }}</p>

                    </div>
                @endforeach



            </div>
        </aside>

        <!-- CHAT AREA -->
        <main class="flex-1 flex flex-col bg-gray-50">

            <!-- CHAT HEADER -->
            <div class="h-16 bg-white border-b flex items-center justify-between px-6">


{{$slot}}

            </div>

            <!-- CHAT MESSAGES -->



    </div>


    </main>

    </div>

</body>

</html>
