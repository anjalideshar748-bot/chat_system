<x-default-page>




<!-- APP WRAPPER -->
<div class="max-w-[1400px] mx-auto h-screen md:h-[92vh] md:py-6">

    <div class="h-full bg-white md:rounded-2xl shadow-2xl overflow-hidden
                flex flex-col md:flex-row">

        <!-- ================= CHAT AREA ================= -->
        <main class="flex-1 flex flex-col bg-gray-50" >

            <!-- CHAT HEADER -->
          <div class="flex items-center gap-3 shadow-md p-3 rounded-lg bg-white" >

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
    <div>

    </div>

</div>

<!-- MESSAGES -->
<div class="flex-auto p-4 overflow-y-auto space-y-3">

@foreach($messages as $msg)

    @if($msg->sender_id == auth()->id())

        <!-- SENT MESSAGE -->
        <div class="flex justify-end items-center gap-2 group">

            <!-- Delete Icon (Outside Bubble) -->
            <form method="POST"
                  action="{{ route('message.delete', $msg->id) }}"
                  class="hidden group-hover:block">
                @csrf
                @method('DELETE')

                <button type="submit"
                        class="text-gray-400 hover:text-red-500 transition">

                    <!-- Trash SVG Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-5 w-5"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                         stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m-1-3h-4a1 1 0 00-1 1v1h6V5a1 1 0 00-1-1z"/>
                    </svg>
                </button>
            </form>

            <!-- Message Bubble -->
            <div class="bg-[#3c8c6d] text-white px-4 py-2 rounded-2xl max-w-xs">
                {{ $msg->message }}
            </div>

        </div>

    @else

        <!-- RECEIVED MESSAGE -->
        <div class="flex justify-start">
            <div class="bg-gray-200 px-4 py-2 rounded-2xl max-w-xs">
                {{ $msg->message }}
            </div>
        </div>

    @endif

@endforeach

</div>


           <!-- INPUT -->
<div class="h-18 px-4 md:px-6 py-3 bg-white border-t">

   <form class="flex items-center gap-3" method="post" action="{{ route('message.send') }}">
    @csrf

    <input type="hidden" name="receiver_id" value="{{ $user->id }}">
    <input type="hidden" name="sender_id" value="{{ Auth::user()->id }}">
    <input
        type="text" name="message"
        placeholder="Type your message here"
        class="flex-1 bg-gray-100 rounded-full px-4 py-2
               focus:outline-none focus:ring-2 focus:ring-[#3c8c6d]"
    >

    <button type="submit"
        class="w-11 h-11 md:w-12 md:h-12
               flex items-center justify-center
               rounded-full bg-[#3c8c6d]
               text-white text-lg
               hover:scale-105 transition">
        ➤
    </button>
</form>

</div>
        </main>

    </div>
</div>


</x-default-page>
