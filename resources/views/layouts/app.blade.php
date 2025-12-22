<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Chat ONN</title>

  <!-- Tailwind CDN -->
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    body { font-family: Inter, sans-serif; }
  </style>
</head>
<body class="bg-gray-100 min-h-screen">

<!-- Header -->
<header class="bg-white shadow px-6 py-4 flex justify-between items-center">
  <h1 class="text-xl font-bold">talk</h1>
  <p class="text-sm text-purple-600 font-medium">Create memorable talks</p>
</header>

<!-- Main Layout -->
<div class="grid grid-cols-12 h-[calc(100vh-72px)]">

  <!-- Chats Sidebar -->
  <aside class="col-span-3 bg-white border-r p-4 overflow-y-auto">
    <div class="flex justify-between items-center mb-4">
      <h2 class="font-semibold text-lg">Chats</h2>
      <button class="w-8 h-8 bg-purple-500 text-white rounded-full hover:bg-purple-400 transition">+</button>
    </div>

    <input
      type="text"
      placeholder="Search"
      class="w-full mb-4 px-4 py-2 rounded-full bg-gray-100
             focus:outline-none focus:ring-2 focus:ring-purple-300 transition"
    />

    <!-- Chat Item -->
    <div class="space-y-2">
      <div class="flex items-center gap-3 p-3 rounded-lg hover:bg-purple-50 cursor-pointer transition">
        <img src="https://i.pravatar.cc/40?img=11" class="rounded-full">
        <div>
          <p class="font-medium">Ankit Mishra</p>
          <p class="text-xs text-gray-500">Are we meeting today?</p>
        </div>
      </div>

      <div class="flex items-center gap-3 p-3 rounded-lg bg-purple-100 cursor-pointer">
        <img src="https://i.pravatar.cc/40?img=12" class="rounded-full">
        <div>
          <p class="font-medium">Kirti Yadav</p>
          <p class="text-xs text-gray-500">Are you there?</p>
        </div>
      </div>

      <div class="flex items-center gap-3 p-3 rounded-lg hover:bg-purple-50 cursor-pointer transition">
        <img src="https://i.pravatar.cc/40?img=13" class="rounded-full">
        <div>
          <p class="font-medium">Harshit Nagar</p>
          <p class="text-xs text-gray-500">Last night party was awesome</p>
        </div>
      </div>
    </div>
  </aside>

  <!-- Chat Section -->
  <section class="col-span-6 flex flex-col bg-gray-50">

    <!-- Chat Header -->
    <div class="flex justify-between items-center bg-white px-6 py-4 border-b">
      <div class="flex items-center gap-3">
        <img src="https://i.pravatar.cc/40?img=12" class="rounded-full">
        <div>
          <p class="font-semibold">Kirti Yadav</p>
          <p class="text-xs text-gray-500">Last seen 3 hours ago</p>
        </div>
      </div>
      <div class="flex gap-4 text-gray-500">
        <span class="hover:text-purple-500 cursor-pointer">📞</span>
        <span class="hover:text-purple-500 cursor-pointer">🎥</span>
        <span class="hover:text-purple-500 cursor-pointer">⋮</span>
      </div>
    </div>

    <!-- Messages -->
    <div class="flex-1 p-6 space-y-6 overflow-y-auto">

      <div class="flex justify-end">
        <div class="bg-purple-500 text-white px-4 py-3 rounded-2xl hover:shadow-lg transition">
          Hey Listen
        </div>
      </div>

      <div class="flex justify-end">
        <div class="bg-purple-500 text-white px-4 py-3 rounded-2xl max-w-md hover:shadow-lg transition">
          I really like your idea, but I still think we can do more in this.
        </div>
      </div>

      <div class="flex">
        <div class="bg-white px-4 py-3 rounded-2xl max-w-md shadow hover:shadow-md transition">
          Let’s work together and create something more awesome.
        </div>
      </div>

      <div class="flex justify-end">
        <div class="bg-purple-500 text-white px-4 py-3 rounded-2xl hover:shadow-lg transition">
          Sounds perfect!
        </div>
      </div>

    </div>

    <!-- Message Input -->
    <div class="bg-white p-4 border-t flex items-center gap-3">
      <input
        type="text"
        placeholder="Type a message here..."
        class="flex-1 px-4 py-2 rounded-full bg-gray-100
               focus:outline-none focus:ring-2 focus:ring-purple-300 transition"
      />
      <button class="w-10 h-10 bg-purple-500 text-white rounded-full
                     hover:bg-purple-400 active:scale-95 transition">
        ➤
      </button>
    </div>

  </section>

  <!-- Notifications -->
  <aside class="col-span-3 bg-white border-l p-4 overflow-y-auto">
    <h3 class="font-semibold text-lg mb-4">Notifications</h3>

    <div class="space-y-3 mb-6">
      <div class="flex gap-3 p-2 rounded-lg hover:bg-gray-100 transition">
        <img src="https://i.pravatar.cc/36?img=21" class="rounded-full">
        <p class="text-sm"><span class="font-medium">@Ankita</span> mentioned you</p>
      </div>
      <div class="flex gap-3 p-2 rounded-lg hover:bg-gray-100 transition">
        <img src="https://i.pravatar.cc/36?img=22" class="rounded-full">
        <p class="text-sm"><span class="font-medium">@Prakash</span> added you to Study group</p>
      </div>
    </div>

    <h3 class="font-semibold text-lg mb-3">Suggestions</h3>
    <div class="space-y-3">
      <div class="flex justify-between items-center">
        <div class="flex gap-3 items-center">
          <img src="https://i.pravatar.cc/36?img=23" class="rounded-full">
          <p class="text-sm font-medium">Abhiman Singh</p>
        </div>
        <button class="text-sm bg-purple-500 text-white px-3 py-1 rounded-full hover:bg-purple-400 transition">
          Add
        </button>
      </div>
    </div>
  </aside>

</div>
</body>
</html>
