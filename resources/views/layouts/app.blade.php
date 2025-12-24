<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chat TECH UI</title>

  <!-- Tailwind CDN -->
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    body { font-family: Inter, sans-serif; }
  </style>
</head>
<body class="bg-green-900 min-h-screen flex items-center justify-center">

<!-- Main Container -->
<div class="w-full max-w-7xl h-[90vh] bg-white rounded-xl overflow-hidden shadow-2xl grid grid-cols-12">

  <!-- Sidebar -->
  <aside class="col-span-3 bg-green-800 text-white p-4 flex flex-col">

    <!-- Header -->
    <div class="flex items-center justify-between mb-4">
      <h1 class="font-bold text-lg tracking-wide">Chat TECH</h1>
      <button class="w-8 h-8 bg-green-600 rounded-full hover:bg-green-500 transition">+</button>
    </div>

    <!-- Search -->
    <input
      type="text"
      placeholder="Search"
      class="mb-4 px-4 py-2 rounded bg-green-700 placeholder-green-300
             focus:outline-none focus:ring-2 focus:ring-green-300 transition"
    />

    <!-- Active Now -->
    <p class="text-sm text-green-300 mb-2">Active Now</p>

    <div class="space-y-2 overflow-y-auto">

      <!-- User -->
      <div class="flex items-center gap-3 p-2 rounded-lg hover:bg-green-700 cursor-pointer transition">
        <img src="https://i.pravatar.cc/40?img=1" class="rounded-full">
        <div>
          <p class="font-medium">Stephen Ramirez</p>
          <p class="text-xs text-green-300">Lorem ipsum is simply...</p>
        </div>
      </div>

      <div class="flex items-center gap-3 p-2 rounded-lg hover:bg-green-700 cursor-pointer transition">
        <img src="https://i.pravatar.cc/40?img=2" class="rounded-full">
        <div>
          <p class="font-medium">Mildred Peterson</p>
          <p class="text-xs text-green-300">Lorem ipsum is simply...</p>
        </div>
      </div>

      <div class="flex items-center gap-3 p-2 rounded-lg hover:bg-green-700 cursor-pointer transition">
        <img src="https://i.pravatar.cc/40?img=3" class="rounded-full">
        <div>
          <p class="font-medium">Patrick Gordon</p>
          <p class="text-xs text-green-300">Lorem ipsum is simply...</p>
        </div>
      </div>

      <!-- Active Group -->
      <div class="flex items-center gap-3 p-2 rounded-lg bg-green-700 cursor-pointer">
        <img src="https://i.pravatar.cc/40?img=4" class="rounded-full">
        <div>
          <p class="font-medium">Jerry Lawson</p>
          <span class="text-xs bg-green-500 px-2 rounded">GROUP</span>
        </div>
      </div>

      <p class="text-sm text-green-300 mt-4">Recent Active Profile</p>

      <div class="flex items-center gap-3 p-2 rounded-lg hover:bg-green-700 cursor-pointer transition">
        <img src="https://i.pravatar.cc/40?img=5" class="rounded-full">
        <div>
          <p class="font-medium">Jordan Day</p>
          <p class="text-xs text-green-300">Lorem ipsum is simply...</p>
        </div>
      </div>

      <div class="flex items-center gap-3 p-2 rounded-lg hover:bg-green-700 cursor-pointer transition">
        <img src="https://i.pravatar.cc/40?img=6" class="rounded-full">
        <div>
          <p class="font-medium">Hannah Banks</p>
          <p class="text-xs text-green-300">Lorem ipsum is simply...</p>
        </div>
      </div>

    </div>
  </aside>

  <!-- Chat Area -->
  <section class="col-span-9 flex flex-col bg-gray-50">

    <!-- Chat Header -->
    <div class="flex justify-between items-center px-6 py-4 bg-white border-b">
      <div class="flex items-center gap-3">
        <img src="https://i.pravatar.cc/40?img=7" class="rounded-full">
        <p class="font-semibold">Rachel Hoffman</p>
      </div>
      <div class="flex gap-4 text-gray-500">
        <span class="cursor-pointer hover:text-green-600 transition">📞</span>
        <span class="cursor-pointer hover:text-green-600 transition">🎥</span>
        <span class="cursor-pointer hover:text-green-600 transition">⋮</span>
      </div>
    </div>

    <!-- Messages -->
    <div class="flex-1 p-6 space-y-6 overflow-y-auto">

      <!-- Left -->
      <div class="flex gap-3 items-start">
        <img src="https://i.pravatar.cc/36?img=8" class="rounded-full">
        <div>
          <div class="bg-gray-100 px-4 py-3 rounded-xl hover:shadow transition">
            What is Lorem Ipsum dummy text?
          </div>
          <p class="text-xs text-gray-400 mt-1">4:30 am</p>
        </div>
      </div>

      <!-- Right -->
      <div class="flex justify-end gap-3">
        <div class="text-right">
          <div class="bg-white px-4 py-3 rounded-xl shadow hover:shadow-md transition max-w-md">
            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
          </div>
          <p class="text-xs text-gray-400 mt-1">4:35 am</p>
        </div>
        <img src="https://i.pravatar.cc/36?img=7" class="rounded-full">
      </div>

      <!-- Left -->
      <div class="flex gap-3 items-start">
        <img src="https://i.pravatar.cc/36?img=8" class="rounded-full">
        <div>
          <div class="bg-gray-100 px-4 py-3 rounded-xl hover:shadow transition">
            Where does it come from?
          </div>
          <p class="text-xs text-gray-400 mt-1">4:40 am</p>
        </div>
      </div>

      <!-- Typing -->
      <div class="flex justify-end items-center gap-3">
        <span class="text-sm italic text-gray-400">typing...</span>
        <img src="https://i.pravatar.cc/36?img=7" class="rounded-full">
      </div>

    </div>

    <!-- Input -->
    <div class="bg-white p-4 border-t flex items-center gap-3">
      <input
        type="text"
        placeholder="Type a message..."
        class="flex-1 px-4 py-2 rounded-full border
               focus:outline-none focus:ring-2 focus:ring-green-400 transition"
      />
      <button
        class="px-5 py-2 bg-green-600 text-white rounded-full
               hover:bg-green-500 active:scale-95 transition">
        Send
      </button>
    </div>

  </section>

</div>
</body>
</html>
