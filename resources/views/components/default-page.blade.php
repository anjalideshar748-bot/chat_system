 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     <title>Chatting system</title>

     @vite(['resources/css/app.css', 'resources/js/app.js'])
     <script src="https://cdn.tailwindcss.com"></script>
 </head>

 <body class=" text-gray-800">

     <div class="w-full h-screen flex flex-col">

         <!-- HEADER -->
         <header
             class="px-10 py-2 backdrop-blur bg-gradient-to-r from-emerald-600 to-emerald-300
                   flex justify-between items-center
                   sticky top-0 z-20 shadow-sm">
             <div>
                 <p class="text-white text-3xl font-semibold">Talk</p>
                 {{-- <h1 class="text-3xl font-semibold tracking-tight text-gray-900">
                    {{ auth()->user()->name }}
                </h1> --}}
             </div>

             <div class="flex items-center">
                 <!-- SEARCH -->
                 <div class="px-7 pt-6">
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


             </div>
         </header>

         <!-- NAVIGATION TABS -->
         <nav class="px-5 pt-6">
             <div class="inline-flex bg-white w-full p-1 shadow">
                 <a href="/dashboard"
                     class="px-6 py-2 rounded-full text-sm font-medium
                           text-[#3c8c6d]
                           hover:bg-[#7FE3C3]/30 transition">
                     All Chats
                 </a>
                 <a href="{{ route('friend.requests') }}"
                     class="px-6 py-2 rounded-full text-sm font-medium
                    text-[#3c8c6d]
                    hover:bg-[#7FE3C3]/30 transition">
                     Requests
                 </a>


                 <a href="{{ route('profile.edit') }}"
                     class="px-6 py-2 rounded-full text-sm font-medium
                           text-[#3c8c6d]
                           hover:bg-[#7FE3C3]/30 transition">
                     Profile
                 </a>

                 <form action="{{ route('logout') }}" method="POST">
                     @csrf
                     <button type="submit"
                         class="px-6 py-2 rounded-full text-sm font-medium
                           text-[#3c8c6d]
                           hover:bg-[#7FE3C3]/30 transition">
                         Logout
                     </button>
                 </form>
             </div>
         </nav>

         <!-- CONTENT -->
         <main class="flex-1 overflow-y-auto px-5 py-6 space-y-3">
             {{ $slot }}
         </main>

     </div>


 </body>

 </html>
