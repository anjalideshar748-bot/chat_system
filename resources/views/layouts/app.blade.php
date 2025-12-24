<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Chat Web UI</title>

  <!-- Tailwind CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 h-screen flex">

<!-- Main Container -->
<div class="flex w-full max-w-7xl mx-auto shadow-2xl rounded-xl overflow-hidden">

  <!-- Sidebar -->
  <aside class="w-1/3 bg-white border-r flex flex-col">

    <!-- Sidebar Header -->
    <div class="p-5 bg-gradient-to-r from-teal-500 to-green-400 text-white">
      <h2 class="text-xl font-semibold">Messages</h2>
      <input
        type="text"
        placeholder="Search"
        class="mt-4 w-full px-4 py-2 rounded-full text-gray-700
               focus:outline-none focus:ring-2 focus:ring-teal-300 transition"
      />
    </div>

    <!-- Chat List -->
    <div class="flex-1 overflow-y-auto">

      <div class="p-4 space-y-2">

        <!-- Chat Item -->
        <div class="flex items-center gap-3 p-3 rounded-xl
                    hover:bg-gray-100 cursor-pointer transition">
          <img src="https://i.pravatar.cc/45?img=10" class="rounded-full">
          <div class="flex-1">
            <p class="font-medium">Jane ❤️</p>
            <p class="text-sm text-gray-500 truncate">
              Hello, are you home?
            </p>
          </div>
          <span class="text-xs text-gray-400">5m</span>
        </div>

        <div class="flex items-center gap-3 p-3 rounded-xl
                    bg-gray-100 cursor-pointer">
          <img src="https://i.pravatar.cc/45?img=11" class="rounded-full">
          <div class="flex-1">
            <p class="font-medium">Leslie</p>
            <p class="text-sm text-gray-500 truncate">
              Yes, I will be available tomorrow...
            </p>
          </div>
          <span class="text-xs text-gray-400">3:00 PM</span>
        </div>

        <div class="flex items-center gap-3 p-3 rounded-xl
                    hover:bg-gray-100 cursor-pointer transition">
          <img src="https://i.pravatar.cc/45?img=12" class="rounded-full">
          <div class="flex-1">
            <p class="font-medium">Dianne</p>
            <p class="text-sm text-gray-500 truncate">
              Nice performance today!
            </p>
          </div>
          <span class="text-xs text-gray-400">Yesterday</span>
        </div>

      </div>

    </div>
  </aside>

  <!-- Chat Area -->
  <main class="flex-1 flex flex-col bg-gray-50">

    <!-- Chat Header -->
    <div class="p-4 bg-white border-b flex items-center gap-3">
      <img src="https://i.pravatar.cc/45?img=11" class="rounded-full">
      <div>
        <p class="font-semibold">Leslie</p>
        <p class="text-xs text-green-500">Online</p>
      </div>
    </div>

    <!-- Messages -->
    <div class="flex-1 p-6 space-y-4 overflow-y-auto">

      <p class="text-center text-xs text-gray-400">Today</p>

      <!-- Left -->
      <div class="flex">
        <div class="bg-teal-100 px-4 py-2 rounded-2xl max-w-md
                    hover:shadow transition">
          Hey! what’s the update?
        </div>
      </div>

      <!-- Right -->
      <div class="flex justify-end">
        <div class="bg-teal-500 text-white px-4 py-2 rounded-2xl max-w-md
                    hover:shadow transition">
          Yeah, will be up in a minute.
        </div>
      </div>

      <div class="flex">
        <div class="bg-teal-100 px-4 py-2 rounded-2xl max-w-md">
          Are you sure? I don’t see it.
        </div>
      </div>

      <div class="flex justify-end">
        <div class="bg-teal-500 text-white px-4 py-2 rounded-2xl max-w-md">
          I think it’s not today.
        </div>
      </div>

      <div class="flex">
        <div class="bg-teal-100 px-4 py-2 rounded-2xl max-w-md">
          Oh, I see. I was hoping…
        </div>
      </div>

    </div>

    <!-- Message Input -->
    <div class="p-4 bg-white border-t flex items-center gap-3">
      <input
        type="text"
        placeholder="Type a message..."
        class="flex-1 px-4 py-2 rounded-full bg-gray-100
               focus:outline-none focus:ring-2 focus:ring-teal-400 transition"
      />
      <button
        class="px-5 py-2 bg-teal-500 text-white rounded-full
               hover:bg-teal-400 active:scale-95 transition">
        Send
      </button>
    </div>

  </main>

</div>

</body>
</html>
