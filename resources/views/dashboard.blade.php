{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
  <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Logout</button>
  </form>

</body>
</html> --}}

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Chat UI</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="h-screen w-screen bg-[#1f6b4e] flex items-center justify-center">
     <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Logout</button>
  </form>

<!-- MAIN WRAPPER -->
<div class="w-[95%] h-[95%] bg-white rounded-lg shadow-xl flex overflow-hidden">

  <!-- SIDEBAR -->
  <aside class="w-1/4 bg-[#2f7f5f] text-white flex flex-col">

    <!-- Logo -->
    <div class="p-4 flex items-center justify-between border-b border-white/20">
      <h1 class="font-bold text-lg">talk</h1>
      <button class="bg-white text-[#2f7f5f] rounded-full w-8 h-8 hover:scale-110 transition">+</button>
    </div>

    <!-- Search -->
    {{-- <div class="p-4">
      <input
        type="text"
        placeholder="Search"
        class="w-full px-4 py-2 rounded bg-[#3c8c6d] placeholder-white/70
               focus:outline-none focus:ring-2 focus:ring-white"
      />
    </div> --}}
    <form method="get" action="{{route('search_user')}}" class="p-4">
      <input type="text" name="search" placeholder="Search" class="w-full px-4 py-2 rounded bg-[#3c8c6d] placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-white"
      />
    </form>

    <!-- Contacts -->
    <div class="flex-1 overflow-y-auto space-y-1 px-2">

      <div class="px-3 py-3 rounded-lg bg-[#3c8c6d] cursor-pointer">
        <p class="font-semibold">{{$user->name}}</p>
        <p class="text-sm text-white/70 truncate">Lorem Ipsum is simply...</p>
      </div>

      

    </div>
  </aside>

  <!-- CHAT AREA -->
  <main class="flex-1 flex flex-col bg-gray-50">

    <!-- CHAT HEADER -->
    <div class="h-16 bg-white border-b flex items-center justify-between px-6">

      <div class="flex items-center gap-3">
        <img src="https://i.pravatar.cc/40?img=32" class="rounded-full">
        <p class="font-semibold">Rachel Hoffman</p>
      </div>

      <!-- CALL ICONS -->
      <div class="flex gap-4 text-gray-500">
        <button class="hover:text-green-600 transition" title="Video Call">📹</button>
        <button class="hover:text-green-600 transition" title="Audio Call">📞</button>
        <button class="hover:text-gray-800 transition">⋮</button>
      </div>

    </div>

    <!-- MESSAGES -->
    <div class="flex-1 p-6 overflow-y-auto space-y-6">

      <div class="flex gap-3 items-start">
        <img src="https://i.pravatar.cc/35?img=12" class="rounded-full">
        <div>
          <div class="bg-gray-200 px-4 py-2 rounded-xl max-w-lg">
            What is Lorem Ipsum dummy text?
          </div>
          <span class="text-xs text-gray-400">4:30 am</span>
        </div>
      </div>

      <div class="flex gap-3 justify-end items-start">
        <div class="text-right">
          <div class="bg-gray-200 px-4 py-2 rounded-xl max-w-lg">
            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
          </div>
          <span class="text-xs text-gray-400">4:35 am</span>
        </div>
        <img src="https://i.pravatar.cc/35?img=32" class="rounded-full">
      </div>

      <div class="flex gap-3 items-start">
        <img src="https://i.pravatar.cc/35?img=12" class="rounded-full">
        <div>
          <div class="bg-gray-200 px-4 py-2 rounded-xl max-w-lg">
            Where does it come from?
          </div>
          <span class="text-xs text-gray-400">4:40 am</span>
        </div>
      </div>

      <div class="flex justify-end">
        <div class="text-xs text-gray-400 italic">typing...</div>
      </div>

    </div>

    <!-- INPUT -->
    <div class="h-16 bg-white border-t flex items-center px-6 gap-4">
      <input
        type="text"
        placeholder="Type a message..."
        class="flex-1 px-4 py-2 rounded-full bg-gray-100
               focus:outline-none focus:ring-2 focus:ring-green-500"
      />
      <button
        class="bg-green-600 text-white px-6 py-2 rounded-full
               hover:bg-green-500 active:scale-95 transition">
        Send
      </button>
    </div>

  </main>

</div>

</body>
</html>
