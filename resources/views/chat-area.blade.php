<x-default-page>




<!-- APP WRAPPER -->
<div class="max-w-[1400px] mx-auto h-screen md:h-[92vh] md:py-6">

    <div class="h-full bg-white md:rounded-2xl shadow-2xl overflow-hidden
                flex flex-col md:flex-row">

        <!-- ================= CHAT AREA ================= -->
        <main class="flex-1 flex flex-col bg-gray-50">

            <!-- CHAT HEADER -->
          <div class="flex items-center gap-3">

    <button class="md:hidden text-xl text-gray-500">
        ←
    </button>

    <img src="{{ $user->profile_photo_url ?? 'https://i.pravatar.cc/40' }}"
         class="w-9 h-9 rounded-full">

    <div>
        <p class="font-semibold leading-tight">
            {{ $user->name }}
        </p>

        <p class="text-xs text-green-600">
            {{ $user->is_online ? 'Active now' : 'Offline' }}
        </p>
    </div>
</div>


            <!-- MESSAGES -->
            <div class="flex-1 p-4 md:p-8 overflow-y-auto space-y-6">

                <!-- Incoming -->
                <div class="flex gap-3">
                    <img src="https://i.pravatar.cc/36"
                         class="w-8 h-8 rounded-full">

                    <div
                        class="bg-white px-4 py-3 rounded-2xl shadow
                               text-sm max-w-[80%] md:max-w-[60%]">
                        Hello! This works perfectly on mobile too.
                    </div>
                </div>

                <!-- Outgoing -->
                <div class="flex justify-end gap-3">
                    <div
                        class="bg-[#3c8c6d] text-white px-4 py-3
                               rounded-2xl shadow text-sm
                               max-w-[80%] md:max-w-[60%]">
                        Clean, responsive, and premium ✨
                    </div>

                    <img src="https://i.pravatar.cc/36?img=5"
                         class="w-8 h-8 rounded-full">
                </div>
            </div>

            <!-- INPUT -->
            <div
                class="h-18 px-4 md:px-6 py-3
                       bg-white border-t
                       flex items-center gap-3">

                <input
                    type="text"
                    placeholder="Type a message..."
                    class="flex-1 px-5 py-3 rounded-full
                           bg-gray-100 text-sm
                           focus:outline-none
                           focus:ring-2 focus:ring-[#3c8c6d]"
                />

                <button
                    class="w-11 h-11 md:w-12 md:h-12
                           rounded-full bg-[#3c8c6d]
                           text-white text-lg
                           hover:scale-105 transition">
                    ➤
                </button>
            </div>

        </main>

    </div>
</div>


</x-default-page>
