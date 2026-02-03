 <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Console | Digital Voting</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#196C3E] text-gray-100">

    <div class="w-full h-screen flex flex-col">

        <!-- HEADER -->
        <header
                    class="px-10 py-6 backdrop-blur bg-[#238B55] border-b border-white/20
                   flex justify-between items-center sticky top-0 z-20 shadow-md">
            <div>
                 <p class="text-green-200 text-sm">Welcome back,</p>
                <h1 class="text-3xl font-semibold tracking-tight text-white">
                    {{ auth()->user()->name }}
                </h1>

            </div>

            <div class="flex items-center gap-3">
                <!-- SEARCH -->
                <div class="px-10 pt-6">
                    <form method="get" action="{{ route('search_user') }}">
                       <div class="relative">
                            <input type="text" name="search" placeholder="Search users..."
                                value="{{ request('search') }}"
                                class="w-full px-5 py-3 rounded-xl
                                       bg-[#D9F6E4] text-gray-800 placeholder-gray-500
                                       shadow-md
                                       focus:outline-none focus:ring-2 focus:ring-[#3ECFA3]/70" />
                            <span class="absolute right-4 top-3 text-gray-400">⌕</span>
                        </div>
                    </form>
                </div>

                <button
                    class="w-11 h-11 rounded-full border border-gray-200
                       flex items-center justify-center
                       hover:bg-[#3ECFA3]/20 transition">
                    ⋮
                </button>
            </div>
        </header>



        <!-- NAVIGATION TABS -->
        <nav class="px-10 pt-6">
            <div class="inline-flex bg-[#D9F6E4] rounded-full p-1 shadow-md">
                <a href="#"
                    class="px-6 py-2 rounded-full text-sm font-medium
                         bg-[#196C3E] text-white
                      transition">
                    All Chats
                </a>

                <a href="#"
                    class="px-6 py-2 rounded-full text-sm font-medium
                     text-[#196C3E] hover:text-white
                           hover:bg-[#3ECFA3]/40 transition">
                    Requests
                </a>
            </div>
        </nav>

        <!-- CONTENT -->
        <main class="flex-1 overflow-y-auto px-10 py-6 space-y-3">
            {{ $slot }}
        </main>

    </div>

</body>

</html>

