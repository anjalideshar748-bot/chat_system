 <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Console | Digital Voting</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#EAFBF3] text-gray-800">

    <div class="w-full h-screen flex flex-col">

        <!-- HEADER -->
        <header
                    class="px-10 py-6 backdrop-blur bg-[#BFF3DC]
                   border-b border-[#3c8c6d]/20
                   flex justify-between items-center
                   sticky top-0 z-20 shadow-sm">
            <div>
              <p class="text-[#3c8c6d] text-sm">Welcome back,</p>
               <h1 class="text-3xl font-semibold tracking-tight text-gray-900">
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
                                       bg-white text-gray-800 placeholder-gray-400
                                       shadow
                                       focus:outline-none
                                       focus:ring-2 focus:ring-[#7FE3C3]" />
                            <span class="absolute right-4 top-3 text-gray-400">⌕</span>
                        </div>
                    </form>
                </div>

                <button
                     class="w-11 h-11 rounded-full border border-gray-300
                           flex items-center justify-center
                           hover:bg-[#7FE3C3]/40 transition">
                    ⋮
                </button>
            </div>
        </header>



        <!-- NAVIGATION TABS -->
        <nav class="px-10 pt-6">
            <div class="inline-flex bg-white rounded-full p-1 shadow">
                <a href="#"
                    class="px-6 py-2 rounded-full text-sm font-medium
                           bg-[#3c8c6d] text-white
                           hover:bg-[#2f6f56] transition">
                    All Chats
                </a>

                 <a href="#"
                    class="px-6 py-2 rounded-full text-sm font-medium
                           text-[#3c8c6d]
                           hover:bg-[#7FE3C3]/30 transition">
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

