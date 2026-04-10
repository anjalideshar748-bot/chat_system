<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Talk | Modern Chat</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        * { transition: all 0.2s ease; }
        body {
            background: linear-gradient(135deg, #f0fdf4 0%, #e6f7f0 100%);
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }

        .messages-container::-webkit-scrollbar {
            width: 5px;
        }
        .messages-container::-webkit-scrollbar-track { background: #e6f7f0; border-radius: 10px; }
        .messages-container::-webkit-scrollbar-thumb { background: #3c8c6d; border-radius: 10px; }
        .messages-container::-webkit-scrollbar-thumb:hover { background: #2d6b52; }

        .friend-item:hover {
            background: linear-gradient(95deg, #e6f7f0 0%, #d1f0e3 100%);
            transform: translateX(4px);
        }
        .friend-item.active {
            background: linear-gradient(95deg, #c8e9db 0%, #b3e2d1 100%);
            border-left: 4px solid #3c8c6d;
        }

        .search-input:focus {
            box-shadow: 0 0 0 3px rgba(60, 140, 109, 0.15);
            border-color: #3c8c6d;
        }

        .message-bubble { animation: fadeInUp 0.3s ease-out; }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .talk-logo {
            background: linear-gradient(135deg, #3c8c6d, #2d6b52);
            box-shadow: 0 4px 15px rgba(60, 140, 109, 0.25);
        }

        .status-pulse {
            animation: pulse-ring 2s infinite;
        }
        @keyframes pulse-ring {
            0% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.5); }
            70% { box-shadow: 0 0 0 8px rgba(16, 185, 129, 0); }
            100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
        }
    </style>
</head>
<body class="h-screen overflow-hidden">

    <div class="flex h-screen w-full">

        <!-- ==================== LEFT SIDEBAR ==================== -->
        <div class="w-full md:w-96 lg:w-96 bg-white/95 backdrop-blur-sm border-r border-teal-100 flex flex-col shadow-2xl z-10">

            <!-- App Header -->
            <div class="p-5 border-b border-teal-100 sidebar-header bg-gradient-to-r from-teal-50 to-emerald-50">
                <div class="flex items-center gap-3">
                    <div class="talk-logo w-11 h-11 rounded-2xl flex items-center justify-center">
                        <i class="fas fa-comment-dots text-white text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold bg-gradient-to-r from-teal-700 to-emerald-600 bg-clip-text text-transparent">Talk</h1>
                        <p class="text-xs text-teal-600 font-medium -mt-1">Chat • Connect • Grow</p>

                    </div>
                </div>
            </div>

            <!-- Search -->
            <div class="p-4 bg-white border-b border-teal-50">
                <form method="GET" action="{{ route('search_user') }}">
                    <div class="relative">
                        <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-teal-400"></i>
                        <input type="text" name="search"
                               placeholder="Search users..."
                               value="{{ request('search') }}"
                               class="search-input w-full pl-11 pr-4 py-3 border border-teal-200 rounded-2xl focus:outline-none bg-gray-50 text-sm">
                    </div>
                </form>
            </div>

            <!-- Friends Header -->
            <div class="px-5 pt-4 pb-3 flex justify-between items-center border-b border-teal-100">
                <h2 class="text-xs font-semibold text-teal-600 uppercase tracking-widest flex items-center gap-2">
                    <i class="fas fa-users"></i>
                    Your Friends
                </h2>

                <span id="onlineCount" class="text-xs bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full font-medium flex items-center gap-1">
                    <i class="fas fa-circle text-[6px]"></i> <a href="{{ route('friend.requests') }}">Friend Requests</a></span>
                </span>
            </div>

            <!-- Friend List -->
            <div id="friendListContainer" class="flex-1 overflow-y-auto p-3 space-y-1">
                <!-- Will be populated by JavaScript / Livewire / Blade -->
                @if($friends->count() > 0)
                    @foreach($friends as $friend)
                    <a href="{{ route('chat.show', $friend->id) }}" class="friend-item block cursor-pointer p-3 rounded-2xl {{ request()->route('id') == $friend->id ? 'active' : '' }}">
                        <div class="flex items-center gap-3">
                            <div class="relative">
                                @if($friend->profile_photo_url)
                                    <img src="{{ $friend->profile_photo_url }}"
                                         class="w-12 h-12 rounded-full object-cover" alt="">
                                @else
                                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-teal-400 to-emerald-500 flex items-center justify-center text-white font-bold text-lg">
                                        {{ strtoupper(substr($friend->name, 0, 1)) }}
                                    </div>
                                @endif
                                <span class="absolute bottom-0 right-0 w-3.5 h-3.5 rounded-full ring-2 ring-white {{ $friend->is_online ? 'bg-emerald-500 status-pulse' : 'bg-gray-400' }}"></span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-semibold text-gray-800 truncate">{{ $friend->name }}</p>
                                <p class="text-xs {{ $friend->is_online ? 'text-emerald-600' : 'text-gray-500' }}">
                                    {{ $friend->is_online ? '● Online now' : 'Offline' }}
                                </p>
                            </div>
                        </div>
                    </a>
                    @endforeach
                @else
                    <div class="text-center py-12 text-teal-400">
                        <i class="fas fa-user-friends text-4xl mb-3 opacity-40"></i>
                        <p class="text-sm">No friends yet</p>
                        <p class="text-xs mt-1">Search and add friends to start chatting</p>
                    </div>
                @endif
            </div>

            <!-- Current User -->
            <div onclick="openProfileModal()" class="p-4 border-t border-teal-100 bg-gradient-to-r from-teal-50 to-white cursor-pointer hover:bg-teal-50">
                <div class="flex items-center gap-3">
                    <div class="relative">
                        @if(auth()->user()->profile_photo_url)
                            <img src="{{ auth()->user()->profile_photo_url }}" class="w-10 h-10 rounded-full object-cover" alt="">
                        @else
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-teal-500 to-emerald-600 flex items-center justify-center text-white font-semibold">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                        @endif
                        <span class="absolute bottom-0 right-0 w-3 h-3 rounded-full bg-emerald-500 ring-2 ring-white status-pulse"></span>
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold text-gray-800">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-emerald-600 flex items-center gap-1">
                            <i class="fas fa-circle text-[6px]"></i> Online
                        </p>
                    </div>
                    <i class="fas fa-cog text-teal-400"></i>
                </div>
            </div>
        </div>

        <!-- ==================== CHAT AREA ==================== -->
        <div class="flex-1 flex flex-col bg-gradient-to-br from-teal-50/70 to-white">
            {{ $slot }}
        </div>
    </div>

    <!-- Profile & Settings Modal -->
    <div id="profileModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <!-- Background overlay -->
        <div class="fixed inset-0 bg-gray-500/75 transition-opacity backdrop-blur-sm" aria-hidden="true" onclick="closeProfileModal()"></div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <!-- Modal panel -->
                <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-md border border-teal-100">
                    <div class="bg-gradient-to-r from-teal-50 to-emerald-50 px-4 py-6 sm:px-6 flex flex-col items-center border-b border-teal-100">
                        <div class="relative mb-3">
                            @if(auth()->user()->profile_photo_url)
                                <img src="{{ auth()->user()->profile_photo_url }}" class="w-20 h-20 rounded-full object-cover shadow-lg border-4 border-white" alt="">
                            @else
                                <div class="w-20 h-20 rounded-full bg-gradient-to-br from-teal-500 to-emerald-600 flex items-center justify-center text-white font-bold text-3xl shadow-lg border-4 border-white">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                            @endif
                            <span class="absolute bottom-1 right-1 w-5 h-5 rounded-full bg-emerald-500 border-4 border-white"></span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900" id="modal-title">{{ auth()->user()->name }}</h3>
                        <p class="text-sm text-teal-600 font-medium">{{ auth()->user()->email }}</p>
                    </div>

                    <div class="bg-white px-4 py-5 sm:p-6 space-y-3">
                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 w-full p-3 rounded-xl hover:bg-teal-50 text-gray-700 transition-colors group border border-transparent hover:border-teal-100">
                            <div class="w-10 h-10 rounded-lg bg-teal-50 text-teal-600 flex items-center justify-center group-hover:bg-teal-100 group-hover:text-teal-700 shadow-sm">
                                <i class="fas fa-user-edit"></i>
                            </div>
                            <div class="flex-1 text-left">
                                <p class="font-semibold text-gray-800">Profile Settings</p>
                                <p class="text-xs text-gray-500">Manage your account details.</p>
                            </div>
                            <i class="fas fa-chevron-right text-teal-300 group-hover:text-teal-500"></i>
                        </a>

                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <button type="submit" class="flex items-center gap-3 w-full p-3 rounded-xl hover:bg-red-50 text-gray-700 transition-colors group border border-transparent hover:border-red-100">
                                <div class="w-10 h-10 rounded-lg bg-red-50 text-red-500 flex items-center justify-center group-hover:bg-red-100 group-hover:text-red-600 shadow-sm">
                                    <i class="fas fa-sign-out-alt"></i>
                                </div>
                                <div class="flex-1 text-left">
                                    <p class="font-semibold text-red-600">Log Out</p>
                                    <p class="text-xs text-red-400">Sign out of your account</p>
                                </div>
                            </button>
                        </form>
                    </div>

                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 border-t border-gray-100">
                        <button type="button" onclick="closeProfileModal()" class="mt-3 inline-flex w-full justify-center rounded-xl bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto transition-colors">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Profile Modal Logic
        function openProfileModal() {
            document.getElementById('profileModal').classList.remove('hidden');
        }

        function closeProfileModal() {
            document.getElementById('profileModal').classList.add('hidden');
        }

        // Close on `Escape` key
        document.addEventListener('keydown', function(event) {
            if (event.key === "Escape") {
                closeProfileModal();
            }
        });

        // Auto scroll messages to bottom on load
        document.addEventListener('DOMContentLoaded', () => {
            const container = document.getElementById('messagesContainer');
            if(container) {
                container.scrollTop = container.scrollHeight;
            }
        });
    </script>

</body>
</html>
