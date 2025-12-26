<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Chat App Web</title>

<script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="h-screen w-screen bg-gray-100 overflow-hidden">

<div class="flex h-full">

 <!-- Sidebar -->
<aside class="w-1/4 bg-white border-r flex flex-col">

  <!-- Logo -->
  <div class="p-5 flex items-center gap-3 bg-gradient-to-r from-teal-500 to-green-500 text-white">
    <img src="7c03777d88ee2dffef97e812961c7b3d-removebg-preview.png" alt="Logo" class="w-10 h-10 rounded-full">
    <h1 class="text-xl font-bold">talk</h1>
  </div>

  <!-- Sidebar Header -->
  <div class="p-5 bg-gradient-to-r from-teal-500 to-green-500 text-white">
    <h2 class="text-lg font-semibold mt-3">Messages</h2>
    <input
      type="text"
      placeholder="Search"
      class="mt-4 w-full px-4 py-2 rounded-full text-gray-700
             focus:outline-none focus:ring-2 focus:ring-teal-300"
    />
  </div>

  <!-- Chat List -->
  <div class="flex-1 overflow-y-auto p-4 space-y-3">

    <div class="flex items-center gap-3 p-3 rounded-xl bg-gray-100 cursor-pointer">
      <img src="https://i.pravatar.cc/45?img=11" class="rounded-full">
      <div class="flex-1">
        <p class="font-medium">Leslie</p>
        <p class="text-sm text-gray-500 truncate">Available tomorrow...</p>
      </div>
      <span class="text-xs text-gray-400">3:00 PM</span>
    </div>

    <div class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-100 cursor-pointer transition">
      <img src="https://i.pravatar.cc/45?img=12" class="rounded-full">
      <div class="flex-1">
        <p class="font-medium">Jane</p>
        <p class="text-sm text-gray-500 truncate">Hello, are you home?</p>
      </div>
      <span class="text-xs text-gray-400">5m</span>
    </div>

  </div>
</aside>



  <!-- Chat Area -->
  <main class="flex-1 flex flex-col bg-gray-50">

    <!-- Chat Header -->
    <div class="p-4 bg-white border-b flex justify-between items-center">

      <div class="flex items-center gap-3">
        <img src="https://i.pravatar.cc/45?img=11" class="rounded-full">
        <div>
          <p class="font-semibold">Leslie</p>
          <p class="text-xs text-green-500">Online</p>
        </div>
      </div>

      <!-- Call Buttons -->
      <div class="flex gap-4">

        <!-- Audio Call -->
        <button
          title="Audio Call"
          class="p-3 rounded-full bg-gray-100 hover:bg-teal-500
                 hover:text-white transition">
          📞
        </button>

        <!-- Video Call -->
        <button
          title="Video Call"
          class="p-3 rounded-full bg-gray-100 hover:bg-teal-500
                 hover:text-white transition">
          🎥
        </button>

        <!-- More -->
        <button
          title="More"
          class="p-3 rounded-full bg-gray-100 hover:bg-gray-200 transition">
          ⋮
        </button>

      </div>

    </div>

    <!-- Messages -->
    <div class="flex-1 overflow-y-auto p-6 space-y-4">

      <p class="text-center text-xs text-gray-400">Today</p>

      <div class="flex">
        <div class="bg-teal-100 px-4 py-2 rounded-2xl max-w-md">
          Hey! what’s the update?
        </div>
      </div>

      <div class="flex justify-end">
        <div class="bg-teal-500 text-white px-4 py-2 rounded-2xl max-w-md">
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

    </div>

    <!-- Input -->
    <div class="p-4 bg-white border-t flex items-center gap-3">
      <input
        type="text"
        placeholder="Type a message..."
        class="flex-1 px-4 py-2 rounded-full bg-gray-100
               focus:outline-none focus:ring-2 focus:ring-teal-400"
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
