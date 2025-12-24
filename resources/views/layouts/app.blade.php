<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Chat UI</title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    body {
      font-family: Inter, sans-serif;
    }
  </style>
</head>
<body class="bg-green-900 min-h-screen flex items-center justify-center">

<!-- App Container -->
<div class="w-full max-w-7xl h-[90vh] bg-white rounded-xl overflow-hidden shadow-2xl grid grid-cols-12">

  <!-- Sidebar -->
  <aside class="col-span-3 bg-green-800 text-white p-4 flex flex-col">

    <!-- Logo -->
    <div class="flex items-center justify-between mb-4">
      <h1 class="font-bold text-lg">Chat TECH</h1>
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

      <!-- User Item -->
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

      <div class="flex items-center gap-3 p-2 rounded-lg bg-green-700 cursor-pointer">
        <img src="https://i.pravatar.cc/40?img=3" class="rounded-full">
        <div>
          <p class="font-medium">Jerry Lawson</p>
          <span class="text-xs bg-green-500 px-2 rounded">GROUP</span>
        </div>
      </div>

    </div>
  </aside>

  <!-- Chat Area -->
  <section class="col-span-9 flex flex-col bg-gray-50">

    <!-- Header -->
    <div class="flex justify-between items-center px-6 py-4 border-b bg-white">
      <div class="flex items-center gap-3">
        <img src="https://i.pravatar.cc/40?img=5" class="rounded-full">
        <p class="font-semibold">Rachel Hoffman</p>
      </div>
      <div class="flex gap-4 text-gray-500">
        <span class="hover:text-green-600 cursor-pointer">📞</span>
        <span class="hover:text-green-600 cursor-pointer">🎥</span>
        <span class="hover:text-green-600 cursor-pointer">⋮</span>
      </div>
    </div>

    <!-- Messages -->
    <div class="flex-1 p-6 space-y-6 overflow-y-auto">

      <!-- Left -->
      <div class="flex items-start gap-3">
        <img src="https://i.pravatar.cc/36?img=6" class="rounded-full">
        <div>
          <div class="bg-white p-4 rounded-xl shadow hover:shadow-md transition">
            What is Lorem Ipsum dummy text?
          </div>
          <p class="text-xs text-gray-400 mt-1">4:30 am</p>
        </div>
      </div>

      <!-- Right -->
      <div class="flex justify-end gap-3">
        <div class="text-right">
          <div class="bg-green-100 p-4 rounded-xl shadow hover:shadow-md transition max-w-md">
            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
          </div>
          <p class="text-xs text-gray-400 mt-1">4:35 am</p>
        </div>
        <img src="https://i.pravatar.cc/36?img=5" class="rounded-full">
      </div>

      <!-- Left -->
      <div class="flex items-start gap-3">
        <img src="https://i.pravatar.cc/36?img=6" class="rounded-full">
        <div>
          <div class="bg-white p-4 rounded-xl shadow hover:shadow-md transition">
            Where does it come from?
          </div>
          <p class="text-xs text-gray-400 mt-1">4:40 am</p>
        </div>
      </div>

      <!-- Typing -->
      <div class="flex justify-end items-center gap-3">
        <span class="text-sm text-gray-400 italic">typing...</span>
        <img src="https://i.pravatar.cc/36?img=5" class="rounded-full">
      </div>

    </div>

    <!-- Input -->
    <div class="p-4 bg-white border-t flex items-center gap-3">
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
