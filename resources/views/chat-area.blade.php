<x-default-page>
    @php
        $renderAttachment = function ($fileMeta) {
            if (!$fileMeta || empty($fileMeta['url'])) {
                return '';
            }

            $name = e($fileMeta['name'] ?? 'Attachment');
            $url = e($fileMeta['url']);
            $downloadUrl = e($fileMeta['download_url'] ?? $url);
            $compression = $fileMeta['compression'] ?? null;
            $originalSize = e($fileMeta['size_label'] ?? '');
            $compressedSize = e($fileMeta['compressed_size_label'] ?? '');
            $compressionNote = $compression === 'gzip' && $compressedSize && $originalSize
                ? '<p class="mt-2 text-[11px] font-medium text-emerald-700">Lossless compression: ' . $compressedSize . ' from ' . $originalSize . '</p>'
                : ($originalSize ? '<p class="mt-2 text-[11px] font-medium text-slate-500">Original size: ' . $originalSize . '</p>' : '');

            if (!empty($fileMeta['is_image'])) {
                return '<a href="' . $downloadUrl . '" target="_blank" class="block mt-2"><img src="' . $url . '" alt="' . $name . '" class="rounded-2xl shadow-md max-w-full h-auto"></a>' . $compressionNote;
            }

            return '<a href="' . $downloadUrl . '" target="_blank" class="mt-2 inline-flex items-center gap-2 rounded-2xl border border-teal-200 bg-teal-50 px-3 py-2 text-sm font-medium text-teal-700 hover:bg-teal-100"><i class="fas fa-paperclip"></i><span class="truncate max-w-[180px]">' . $name . '</span></a>' . $compressionNote;
        };
    @endphp
    <!-- Active Chat -->
    <div id="activeChatPanel" class="flex-1 flex min-h-0 flex-col h-full">
        <!-- Chat Header -->
        <div class="bg-white border-b border-teal-100 px-4 py-3 md:px-6 md:py-4 flex items-center gap-3 md:gap-4 shadow-sm z-10">
            <div id="chatAvatar" class="w-12 h-12 rounded-2xl flex-shrink-0 relative">
                @if($user->profile_photo_url)
                    <img src="{{ $user->profile_photo_url }}" class="w-full h-full rounded-2xl object-cover" alt="">
                @else
                    <div class="w-full h-full rounded-2xl bg-gradient-to-br from-teal-400 to-emerald-500 flex items-center justify-center text-white font-bold text-xl shadow-inner">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                @endif
                <span class="absolute bottom-0 right-0 w-3.5 h-3.5 rounded-full ring-2 ring-white {{ $user->is_online ? 'bg-emerald-500 status-pulse' : 'bg-gray-400' }}"></span>
            </div>
            <div class="flex-1 min-w-0">
                <h2 id="chatUserName" class="font-bold text-lg md:text-xl text-gray-800 truncate">{{ $user->name }}</h2>
                <div id="chatUserStatus" data-default-status="{{ $user->is_online ? 'Online now' : 'Offline' }}" class="text-xs md:text-sm {{ $user->is_online ? 'text-emerald-600' : 'text-gray-500' }} flex items-center gap-1.5 font-medium">
                    <i class="fas fa-circle text-[8px]"></i>
                    <span id="chatUserStatusText">{{ $user->is_online ? 'Online now' : 'Offline' }}</span>
                </div>
            </div>
            <a href="{{ route('dashboard') }}" class="text-teal-500 hover:text-teal-700 bg-teal-50 p-2 rounded-xl shrink-0">
                <i class="fas fa-arrow-left text-xl"></i>
            </a>
        </div>

        <!-- Messages -->
        <div id="messagesContainer" class="flex-1 overflow-y-auto p-3 md:p-6 space-y-3 md:space-y-4 messages-container bg-[#f8fafc]">
            @if($messages->count() > 0)
                @foreach($messages as $msg)
                    @if($msg->sender_id == auth()->id())
                        <!-- SENT MESSAGE -->
                        <!-- SENT MESSAGE -->
                        <div class="flex justify-end message-bubble group" id="msg-container-{{ $msg->id }}">
                            <!-- Delete Icon (Outside Bubble) -->
                            <form method="POST" action="{{ route('message.delete', $msg->id) }}" class="hidden group-hover:flex items-center mr-2 delete-message-form" data-msg-id="{{ $msg->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors p-2 rounded-full hover:bg-red-50" title="Delete message">
                                    <i class="fas fa-trash text-sm"></i>
                                </button>
                            </form>

                            <div class="max-w-[85%] md:max-w-[75%] bg-gradient-to-br from-teal-600 to-teal-700 text-white px-4 py-3 md:px-5 rounded-3xl rounded-br-none shadow-md">
                                @if($msg->message)
                                    <p class="leading-relaxed">{{ $msg->message }}</p>
                                @endif
                                {!! $renderAttachment($msg->file_meta) !!}
                                <span class="text-teal-100 text-[10px] block text-right mt-1 opacity-80">{{ $msg->created_at->format('H:i') }}</span>
                            </div>
                        </div>
                    @else
                        <!-- RECEIVED MESSAGE -->
                        <div class="flex justify-start message-bubble">
                            <div class="max-w-[85%] md:max-w-[75%] bg-white border border-teal-100 px-4 py-3 md:px-5 rounded-3xl rounded-bl-none shadow-sm">
                                @if($msg->message)
                                    <p class="text-gray-800 leading-relaxed">{{ $msg->message }}</p>
                                @endif
                                {!! $renderAttachment($msg->file_meta) !!}
                                <span class="text-gray-400 text-[10px] block text-right mt-1">{{ $msg->created_at->format('H:i') }}</span>
                            </div>
                        </div>
                    @endif
                @endforeach
            @else
                <div class="text-center py-12 text-teal-400/60 mt-20">
                    <i class="fas fa-comments text-5xl mb-4"></i>
                    <p class="text-sm font-medium">No messages yet.</p>
                    <p class="text-xs mt-1">Say hi to start the conversation!</p>
                </div>
            @endif
        </div>

        <!-- Message Input -->
        <div class="bg-white border-t border-teal-100 p-3 md:p-5 z-10">
            <div id="typingIndicator" class="mb-3 hidden items-center gap-2 text-xs font-medium text-teal-600 md:text-sm">
                <span class="inline-flex items-center gap-1 rounded-full bg-teal-50 px-3 py-1.5">
                    <span class="flex gap-1">
                        <span class="h-1.5 w-1.5 animate-bounce rounded-full bg-teal-500 [animation-delay:-0.3s]"></span>
                        <span class="h-1.5 w-1.5 animate-bounce rounded-full bg-teal-500 [animation-delay:-0.15s]"></span>
                        <span class="h-1.5 w-1.5 animate-bounce rounded-full bg-teal-500"></span>
                    </span>
                    <span id="typingIndicatorText">{{ $user->name }} is typing...</span>
                </span>
            </div>
            {{-- <form id="chatForm" method="post" action="{{ route('message.send') }}" class="flex gap-3">
                @csrf
                <input type="hidden" name="receiver_id" value="{{ $user->id }}">

                <input type="text" name="message" id="messageInput"
                       placeholder="Type your message..."
                       required
                       autofocus
                       autocomplete="off"
                       class="flex-1 px-5 py-3 md:py-4 border border-teal-200 rounded-2xl focus:outline-none focus:border-teal-400 focus:ring-4 focus:ring-teal-50 bg-gray-50 transition-all text-sm md:text-base">

                <button id="sendBtn" type="submit"
                        class="bg-gradient-to-r from-teal-600 to-emerald-600 hover:from-teal-700 hover:to-emerald-700 text-white px-6 md:px-8 rounded-2xl flex items-center justify-center shadow-lg shadow-teal-600/20 hover:shadow-xl transition-all hover:-translate-y-0.5">
                    <i class="fas fa-paper-plane text-lg"></i>
                </button>
            </form> --}}

            <form id="chatForm" method="post" action="{{ route('message.send') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="receiver_id" value="{{ $user->id }}">
                <input type="hidden" name="media_url" id="mediaUrl">
                <input type="hidden" name="media_name" id="mediaName">
                <input type="hidden" name="media_mime" id="mediaMime">

                <div class="flex flex-col gap-3 sm:flex-row sm:items-end">
                    <div class="relative w-full flex-1">
                        <input type="text" name="message" id="messageInput"
                               placeholder="Type your message..."
                               autofocus
                               autocomplete="off"
                               class="w-full pr-14 px-4 py-3 md:px-5 md:py-4 border border-teal-200 rounded-2xl focus:outline-none focus:border-teal-400 focus:ring-4 focus:ring-teal-50 bg-gray-50 transition-all text-sm md:text-base">
                        <button type="button" id="emojiToggleBtn" class="absolute right-3 top-1/2 -translate-y-1/2 inline-flex h-10 w-10 items-center justify-center rounded-xl bg-white text-teal-600 shadow-sm ring-1 ring-teal-100 transition hover:bg-teal-50 hover:text-teal-700" aria-label="Open emoji, GIF, and sticker picker" aria-expanded="false">
                            <i class="far fa-smile text-lg"></i>
                        </button>

                        <div id="emojiPickerPanel" class="absolute bottom-[calc(100%+0.75rem)] right-0 z-30 hidden w-[min(22rem,calc(100vw-2rem))] overflow-hidden rounded-3xl border border-teal-100 bg-white shadow-2xl shadow-slate-900/10">
                            <div class="border-b border-teal-100 bg-gradient-to-r from-teal-50 via-white to-emerald-50 px-4 py-3">
                                <div class="flex items-center justify-between gap-3">
                                    <div>
                                        <p class="text-sm font-semibold text-slate-800">Express yourself</p>
                                        <p class="text-xs text-slate-500">Pick an emoji, GIF, or sticker.</p>
                                    </div>
                                    <button type="button" id="emojiPickerClose" class="inline-flex h-8 w-8 items-center justify-center rounded-full text-slate-400 transition hover:bg-white hover:text-slate-700" aria-label="Close picker">
                                        <i class="fas fa-times text-xs"></i>
                                    </button>
                                </div>
                                <div class="mt-3 grid grid-cols-3 gap-2 rounded-2xl bg-white/70 p-1">
                                    <button type="button" class="picker-tab-btn rounded-2xl px-3 py-2 text-sm font-semibold text-slate-600 transition data-[active=true]:bg-teal-600 data-[active=true]:text-white" data-tab="emoji" data-active="true">Emoji</button>
                                    <button type="button" class="picker-tab-btn rounded-2xl px-3 py-2 text-sm font-semibold text-slate-600 transition data-[active=true]:bg-teal-600 data-[active=true]:text-white" data-tab="gif" data-active="false">GIF</button>
                                    <button type="button" class="picker-tab-btn rounded-2xl px-3 py-2 text-sm font-semibold text-slate-600 transition data-[active=true]:bg-teal-600 data-[active=true]:text-white" data-tab="sticker" data-active="false">Sticker</button>
                                </div>
                            </div>

                            <div class="max-h-80 overflow-y-auto p-4">
                                <div class="picker-tab-panel grid grid-cols-6 gap-2" data-panel="emoji">
                                    @foreach (['😀','😁','😂','🤣','😍','😘','😎','🤩','🥳','😭','😡','🙏','👍','🔥','💯','🎉','❤️','👏','😴','🤯','🤝','😇','🙌','💬'] as $emoji)
                                        <button type="button" class="emoji-choice inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-slate-50 text-2xl transition hover:-translate-y-0.5 hover:bg-teal-50" data-emoji="{{ $emoji }}">{{ $emoji }}</button>
                                    @endforeach
                                </div>

                                <div class="picker-tab-panel hidden space-y-3" data-panel="gif">
                                    <div class="grid grid-cols-2 gap-3">
                                        <button type="button" class="media-choice overflow-hidden rounded-2xl border border-teal-100 text-left transition hover:-translate-y-0.5 hover:shadow-md" data-media-type="gif" data-media-url="https://media.giphy.com/media/ICOgUNjpvO0PC/giphy.gif" data-media-name="Celebration GIF" data-media-mime="image/gif">
                                            <img src="https://media.giphy.com/media/ICOgUNjpvO0PC/giphy.gif" alt="Celebration GIF" class="h-28 w-full object-cover">
                                            <span class="block bg-white px-3 py-2 text-xs font-semibold text-slate-700">Celebrate</span>
                                        </button>
                                        <button type="button" class="media-choice overflow-hidden rounded-2xl border border-teal-100 text-left transition hover:-translate-y-0.5 hover:shadow-md" data-media-type="gif" data-media-url="https://media.giphy.com/media/l0MYt5jPR6QX5pnqM/giphy.gif" data-media-name="Happy Dance GIF" data-media-mime="image/gif">
                                            <img src="https://media.giphy.com/media/l0MYt5jPR6QX5pnqM/giphy.gif" alt="Happy Dance GIF" class="h-28 w-full object-cover">
                                            <span class="block bg-white px-3 py-2 text-xs font-semibold text-slate-700">Happy dance</span>
                                        </button>
                                        <button type="button" class="media-choice overflow-hidden rounded-2xl border border-teal-100 text-left transition hover:-translate-y-0.5 hover:shadow-md" data-media-type="gif" data-media-url="https://media.giphy.com/media/3oriO0OEd9QIDdllqo/giphy.gif" data-media-name="Thumbs Up GIF" data-media-mime="image/gif">
                                            <img src="https://media.giphy.com/media/3oriO0OEd9QIDdllqo/giphy.gif" alt="Thumbs Up GIF" class="h-28 w-full object-cover">
                                            <span class="block bg-white px-3 py-2 text-xs font-semibold text-slate-700">Thumbs up</span>
                                        </button>
                                        <button type="button" class="media-choice overflow-hidden rounded-2xl border border-teal-100 text-left transition hover:-translate-y-0.5 hover:shadow-md" data-media-type="gif" data-media-url="https://media.giphy.com/media/26ufdipQqU2lhNA4g/giphy.gif" data-media-name="Laughing GIF" data-media-mime="image/gif">
                                            <img src="https://media.giphy.com/media/26ufdipQqU2lhNA4g/giphy.gif" alt="Laughing GIF" class="h-28 w-full object-cover">
                                            <span class="block bg-white px-3 py-2 text-xs font-semibold text-slate-700">Laughing</span>
                                        </button>
                                    </div>
                                </div>

                                <div class="picker-tab-panel hidden space-y-3" data-panel="sticker">
                                    <div class="grid grid-cols-3 gap-3">
                                        <button type="button" class="media-choice rounded-2xl border border-teal-100 bg-gradient-to-br from-amber-50 to-orange-100 p-3 text-center transition hover:-translate-y-0.5 hover:shadow-md" data-media-type="sticker" data-media-url="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 120 120'%3E%3Crect width='120' height='120' rx='28' fill='%23fff7ed'/%3E%3Ctext x='60' y='73' font-size='54' text-anchor='middle'%3E%F0%9F%98%8D%3C/text%3E%3C/svg%3E" data-media-name="Heart Eyes Sticker" data-media-mime="image/svg+xml">
                                            <div class="flex aspect-square items-center justify-center rounded-2xl bg-white text-5xl shadow-sm">😍</div>
                                            <span class="mt-2 block text-xs font-semibold text-slate-700">Love it</span>
                                        </button>
                                        <button type="button" class="media-choice rounded-2xl border border-teal-100 bg-gradient-to-br from-emerald-50 to-teal-100 p-3 text-center transition hover:-translate-y-0.5 hover:shadow-md" data-media-type="sticker" data-media-url="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 120 120'%3E%3Crect width='120' height='120' rx='28' fill='%23ecfeff'/%3E%3Ctext x='60' y='73' font-size='54' text-anchor='middle'%3E%F0%9F%91%8D%3C/text%3E%3C/svg%3E" data-media-name="Thumbs Up Sticker" data-media-mime="image/svg+xml">
                                            <div class="flex aspect-square items-center justify-center rounded-2xl bg-white text-5xl shadow-sm">👍</div>
                                            <span class="mt-2 block text-xs font-semibold text-slate-700">Nice</span>
                                        </button>
                                        <button type="button" class="media-choice rounded-2xl border border-teal-100 bg-gradient-to-br from-fuchsia-50 to-rose-100 p-3 text-center transition hover:-translate-y-0.5 hover:shadow-md" data-media-type="sticker" data-media-url="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 120 120'%3E%3Crect width='120' height='120' rx='28' fill='%23fff1f2'/%3E%3Ctext x='60' y='73' font-size='54' text-anchor='middle'%3E%F0%9F%8E%89%3C/text%3E%3C/svg%3E" data-media-name="Party Sticker" data-media-mime="image/svg+xml">
                                            <div class="flex aspect-square items-center justify-center rounded-2xl bg-white text-5xl shadow-sm">🎉</div>
                                            <span class="mt-2 block text-xs font-semibold text-slate-700">Party</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="file"  name="file" id="messageFile" class="w-full sm:w-auto text-sm text-gray-600 file:mr-3 file:rounded-xl file:border-0 file:bg-teal-50 file:px-4 file:py-2 file:text-sm file:font-medium file:text-teal-700 hover:file:bg-teal-100">
                    <button id="sendBtn" type="submit"
                            class="w-full sm:w-auto bg-gradient-to-r from-teal-600 to-emerald-600 hover:from-teal-700 hover:to-emerald-700 text-white px-6 md:px-8 py-3 rounded-2xl flex items-center justify-center shadow-lg shadow-teal-600/20 hover:shadow-xl transition-all hover:-translate-y-0.5">
                        <i class="fas fa-paper-plane text-lg"></i>
                    </button>
                </div>
                <div id="selectedMediaPreview" class="mt-3 hidden items-center gap-3 rounded-2xl border border-teal-100 bg-teal-50/60 p-3">
                    <img id="selectedMediaImage" src="" alt="" class="h-14 w-14 rounded-2xl object-cover shadow-sm">
                    <div class="min-w-0 flex-1">
                        <p id="selectedMediaLabel" class="truncate text-sm font-semibold text-slate-700"></p>
                        <p id="selectedMediaType" class="text-xs uppercase tracking-[0.2em] text-teal-600"></p>
                    </div>
                    <button type="button" id="clearSelectedMedia" class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-white text-slate-400 shadow-sm transition hover:text-red-500" aria-label="Remove selected media">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

            </form>
        </div>
    </div>

    <!-- AJAX Chat Interaction Logic -->
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chatForm = document.getElementById('chatForm');
            const messagesContainer = document.getElementById('messagesContainer');
            const messageInput = document.getElementById('messageInput');
            const sendBtn = document.getElementById('sendBtn');

            // Handle Sending Message
            if (chatForm) {
                chatForm.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const formData = new FormData(chatForm);
                    const messageText = messageInput.value.trim();
                    if(!messageText) return;

                    // Disable input during request
                    messageInput.disabled = true;
                    sendBtn.disabled = true;
                    sendBtn.innerHTML = '<i class="fas fa-spinner fa-spin text-lg"></i>';

                    fetch("{{ route('message.send') }}", {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if(data.success) {
                            messageInput.value = '';

                            if (data.encryption_key && data.decryption_key) {
                                console.log("----- RSA KEYS -----");
                                console.log("Encryption Key (Receiver's Public Key):\n" + data.encryption_key);
                                console.log("Decryption Key (Receiver's Private Key):\n" + data.decryption_key);
                                alert("Message Encrypted via RSA!\n\nCheck your Browser Console (F12) to see the Encryption Key and Decryption Key!");
                            }

                            // Build Sent Bubble HTML dynamically
                            const deleteUrl = "{{ url('/message') }}/" + data.message.id;
                            const csrfToken = document.querySelector('input[name="_token"]').value;
                            const msgHtml = `
                            <div class="flex justify-end message-bubble group" id="msg-container-${data.message.id}" style="animation: fadeInUp 0.3s ease-out;">
                                <form method="POST" action="${deleteUrl}" class="hidden group-hover:flex items-center mr-2 delete-message-form" data-msg-id="${data.message.id}">
                                    <input type="hidden" name="_token" value="${csrfToken}">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors p-2 rounded-full hover:bg-red-50" title="Delete message">
                                        <i class="fas fa-trash text-sm"></i>
                                    </button>
                                </form>

                                <div class="max-w-[75%] bg-gradient-to-br from-teal-600 to-teal-700 text-white px-5 py-3 rounded-3xl rounded-br-none shadow-md">
                                    <p class="leading-relaxed">${data.message.message}</p>
                                    <span class="text-teal-100 text-[10px] block text-right mt-1 opacity-80">${data.message.time}</span>
                                </div>
                            </div>
                            `;

                            // Check if no messages placeholder exists and remove it
                            const placeholder = messagesContainer.querySelector('.text-center.py-12');
                            if (placeholder) placeholder.remove();

                            messagesContainer.insertAdjacentHTML('beforeend', msgHtml);
                            messagesContainer.scrollTop = messagesContainer.scrollHeight;
                        }
                    })
                    .catch(error => console.error('Error sending message:', error))
                    .finally(() => {
                        messageInput.disabled = false;
                        sendBtn.disabled = false;
                        sendBtn.innerHTML = '<i class="fas fa-paper-plane text-lg"></i>';
                        messageInput.focus();
                    });
                });
            }

            // Handle Deleting Message (Event Delegation)
            if (messagesContainer) {
                messagesContainer.addEventListener('submit', function(e) {
                    if(e.target.classList.contains('delete-message-form')) {
                        e.preventDefault();

                        if(!confirm('Are you sure you want to delete this message?')) return;

                        const form = e.target;
                        const msgId = form.getAttribute('data-msg-id');
                        const formData = new FormData(form);

                        fetch(form.action, {
                            method: 'POST', // Method override uses DELETE
                            headers: {
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if(data.success) {
                                const msgElement = document.getElementById('msg-container-' + msgId);
                                if(msgElement) {
                                    msgElement.style.transition = 'all 0.3s ease';
                                    msgElement.style.opacity = '0';
                                    msgElement.style.transform = 'translateY(10px) scale(0.95)';
                                    setTimeout(() => msgElement.remove(), 300);
                                }
                            }
                        })
                        .catch(error => console.error('Error deleting message:', error));
                    }
                });
            }
        });
        setTimeout(()=>{
            window.Echo.channel('MessageSent')
            .listen('MessageSent', (e) => {
                console.log(e.message);
                // Optionally, you can implement real-time message updates here
            });
            window.Echo.private('MessageSent.{{ Auth::id() }}')
            .listen('MessageSent', (e) => {
                console.log("Private Channel:", e.message);
            })
        }, 200);

    </script> --}}

    <script>
document.addEventListener('DOMContentLoaded', function() {
    const chatForm = document.getElementById('chatForm');
    const messagesContainer = document.getElementById('messagesContainer');
    const messageInput = document.getElementById('messageInput');
    const messageFile = document.getElementById('messageFile');
    const sendBtn = document.getElementById('sendBtn');
    const emojiToggleBtn = document.getElementById('emojiToggleBtn');
    const emojiPickerPanel = document.getElementById('emojiPickerPanel');
    const emojiPickerClose = document.getElementById('emojiPickerClose');
    const pickerTabButtons = Array.from(document.querySelectorAll('.picker-tab-btn'));
    const pickerTabPanels = Array.from(document.querySelectorAll('.picker-tab-panel'));
    const emojiChoices = Array.from(document.querySelectorAll('.emoji-choice'));
    const mediaChoices = Array.from(document.querySelectorAll('.media-choice'));
    const mediaUrlInput = document.getElementById('mediaUrl');
    const mediaNameInput = document.getElementById('mediaName');
    const mediaMimeInput = document.getElementById('mediaMime');
    const selectedMediaPreview = document.getElementById('selectedMediaPreview');
    const selectedMediaImage = document.getElementById('selectedMediaImage');
    const selectedMediaLabel = document.getElementById('selectedMediaLabel');
    const selectedMediaType = document.getElementById('selectedMediaType');
    const clearSelectedMedia = document.getElementById('clearSelectedMedia');
    const typingIndicator = document.getElementById('typingIndicator');
    const typingIndicatorText = document.getElementById('typingIndicatorText');
    const chatUserStatus = document.getElementById('chatUserStatus');
    const chatUserStatusText = document.getElementById('chatUserStatusText');
    const currentUserId = {{ Auth::id() }};
    const chatUserId = {{ $user->id }};
    const csrfToken = document.querySelector('input[name="_token"]').value;
    const defaultStatusText = chatUserStatus?.dataset.defaultStatus || 'Offline';
    const conversationChannelName = `chat.conversation.${Math.min(currentUserId, chatUserId)}.${Math.max(currentUserId, chatUserId)}`;
    let whisperChannel = null;
    let typingWhisperTimeout = null;
    let stopTypingTimeout = null;
    let typingIndicatorHideTimeout = null;
    let isWhisperingTyping = false;

    function openPicker() {
        if (!emojiPickerPanel || !emojiToggleBtn) {
            return;
        }

        emojiPickerPanel.classList.remove('hidden');
        emojiToggleBtn.setAttribute('aria-expanded', 'true');
    }

    function closePicker() {
        if (!emojiPickerPanel || !emojiToggleBtn) {
            return;
        }

        emojiPickerPanel.classList.add('hidden');
        emojiToggleBtn.setAttribute('aria-expanded', 'false');
    }

    function setActiveTab(tabName) {
        pickerTabButtons.forEach((button) => {
            button.dataset.active = button.dataset.tab === tabName ? 'true' : 'false';
        });

        pickerTabPanels.forEach((panel) => {
            panel.classList.toggle('hidden', panel.dataset.panel !== tabName);
        });
    }

    function insertEmoji(emoji) {
        if (!messageInput) {
            return;
        }

        const start = messageInput.selectionStart ?? messageInput.value.length;
        const end = messageInput.selectionEnd ?? messageInput.value.length;
        const value = messageInput.value;
        messageInput.value = `${value.slice(0, start)}${emoji}${value.slice(end)}`;
        messageInput.focus();
        const cursor = start + emoji.length;
        messageInput.setSelectionRange(cursor, cursor);
        handleLocalTyping();
    }

    function clearSelectedMediaState() {
        mediaUrlInput.value = '';
        mediaNameInput.value = '';
        mediaMimeInput.value = '';
        if (selectedMediaImage) {
            selectedMediaImage.src = '';
            selectedMediaImage.alt = '';
        }
        if (selectedMediaLabel) {
            selectedMediaLabel.textContent = '';
        }
        if (selectedMediaType) {
            selectedMediaType.textContent = '';
        }
        selectedMediaPreview?.classList.add('hidden');
        selectedMediaPreview?.classList.remove('flex');
    }

    function selectMedia({ url, name, mime, type }) {
        mediaUrlInput.value = url;
        mediaNameInput.value = name;
        mediaMimeInput.value = mime;
        selectedMediaImage.src = url;
        selectedMediaImage.alt = name;
        selectedMediaLabel.textContent = name;
        selectedMediaType.textContent = type;
        selectedMediaPreview?.classList.remove('hidden');
        selectedMediaPreview?.classList.add('flex');
        if (messageFile) {
            messageFile.value = '';
        }
        closePicker();
    }

    function showTransientNotice(text, tone = 'neutral') {
        const toneClasses = {
            neutral: 'bg-slate-900/90 text-white',
            warning: 'bg-amber-500 text-white',
            error: 'bg-red-500 text-white',
        };

        const notice = document.createElement('div');
        notice.className = `fixed left-1/2 top-4 z-50 -translate-x-1/2 rounded-xl px-4 py-2 text-sm shadow-lg ${toneClasses[tone] || toneClasses.neutral}`;
        notice.textContent = text;
        document.body.appendChild(notice);

        setTimeout(() => {
            notice.remove();
        }, 2500);
    }

    function escapeHtml(value) {
        const div = document.createElement('div');
        div.textContent = value ?? '';
        return div.innerHTML;
    }

    function removePlaceholder() {
        const placeholder = messagesContainer.querySelector('.text-center.py-12');
        if (placeholder) placeholder.remove();
    }

    function buildFileHtml(file) {
        if (!file || !file.url) {
            return '';
        }

        const safeUrl = escapeHtml(file.url);
        const safeDownloadUrl = escapeHtml(file.download_url || file.url);
        const safeName = escapeHtml(file.name || 'Attachment');
        const compressionNote = file.compression === 'gzip' && file.compressed_size_label && file.size_label
            ? `<p class="mt-2 text-[11px] font-medium text-emerald-700">Lossless compression: ${escapeHtml(file.compressed_size_label)} from ${escapeHtml(file.size_label)}</p>`
            : (file.size_label ? `<p class="mt-2 text-[11px] font-medium text-slate-500">Original size: ${escapeHtml(file.size_label)}</p>` : '');

        if (file.is_image) {
            return `<a href="${safeDownloadUrl}" target="_blank" class="block mt-2"><img src="${safeUrl}" alt="${safeName}" class="rounded-2xl shadow-md max-w-full h-auto"></a>${compressionNote}`;
        }

        return `
            <a href="${safeDownloadUrl}" target="_blank" class="mt-2 inline-flex items-center gap-2 rounded-2xl border border-teal-200 bg-teal-50 px-3 py-2 text-sm font-medium text-teal-700 hover:bg-teal-100">
                <i class="fas fa-paperclip"></i>
                <span class="truncate max-w-[180px]">${safeName}</span>
            </a>
            ${compressionNote}
        `;
    }

    function appendMessageBubble(message, time, isOwn, messageId, file = null) {
        removePlaceholder();

        const safeMessage = escapeHtml(message || '');
        const fileHtml = buildFileHtml(file);

        if (isOwn) {
            const deleteUrl = "{{ url('/message') }}/" + messageId;
            const msgHtml = `
                <div class="flex justify-end message-bubble group" id="msg-container-${messageId}" style="animation: fadeInUp 0.3s ease-out;">
                    <form method="POST" action="${deleteUrl}" class="hidden group-hover:flex items-center mr-2 delete-message-form" data-msg-id="${messageId}">
                        <input type="hidden" name="_token" value="${csrfToken}">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors p-2 rounded-full hover:bg-red-50" title="Delete message">
                            <i class="fas fa-trash text-sm"></i>
                        </button>
                    </form>
                    <div class="max-w-[85%] md:max-w-[75%] bg-gradient-to-br from-teal-600 to-teal-700 text-white px-4 py-3 md:px-5 rounded-3xl rounded-br-none shadow-md">
                        ${safeMessage ? `<p class="leading-relaxed">${safeMessage}</p>` : ''}
                        ${fileHtml}
                        <span class="text-teal-100 text-[10px] block text-right mt-1 opacity-80">${time}</span>
                    </div>
                </div>
            `;

            messagesContainer.insertAdjacentHTML('beforeend', msgHtml);
        } else {
            const msgHtml = `
                <div class="flex justify-start message-bubble" id="msg-container-${messageId}" style="animation: fadeInUp 0.3s ease-out;">
                    <div class="max-w-[85%] md:max-w-[75%] bg-white border border-teal-100 px-4 py-3 md:px-5 rounded-3xl rounded-bl-none shadow-sm">
                        ${safeMessage ? `<p class="text-gray-800 leading-relaxed">${safeMessage}</p>` : ''}
                        ${fileHtml}
                        <span class="text-gray-400 text-[10px] block text-right mt-1">${time}</span>
                    </div>
                </div>
            `;

            messagesContainer.insertAdjacentHTML('beforeend', msgHtml);
        }

        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }

    function setTypingState(isTyping, name = '{{ $user->name }}') {
        if (!typingIndicator || !typingIndicatorText || !chatUserStatusText || !chatUserStatus) {
            return;
        }

        if (isTyping) {
            typingIndicator.classList.remove('hidden');
            typingIndicator.classList.add('flex');
            typingIndicatorText.textContent = `${name} is typing...`;
            chatUserStatus.classList.remove('text-emerald-600', 'text-gray-500');
            chatUserStatus.classList.add('text-teal-600');
            chatUserStatusText.textContent = 'typing...';
            return;
        }

        typingIndicator.classList.add('hidden');
        typingIndicator.classList.remove('flex');
        chatUserStatus.classList.remove('text-teal-600');
        if (defaultStatusText === 'Online now') {
            chatUserStatus.classList.add('text-emerald-600');
        } else {
            chatUserStatus.classList.add('text-gray-500');
        }
        chatUserStatusText.textContent = defaultStatusText;
    }

    function whisperTyping(isTyping) {
        if (!whisperChannel) {
            return;
        }

        whisperChannel.whisper('typing', {
            userId: currentUserId,
            name: '{{ $user->name }}',
            typing: isTyping,
        });
    }

    function scheduleStopTyping() {
        clearTimeout(stopTypingTimeout);
        stopTypingTimeout = setTimeout(() => {
            if (isWhisperingTyping) {
                isWhisperingTyping = false;
                whisperTyping(false);
            }
        }, 1200);
    }

    function handleLocalTyping() {
        const hasText = messageInput.value.trim().length > 0;

        clearTimeout(typingWhisperTimeout);

        if (!hasText) {
            if (isWhisperingTyping) {
                isWhisperingTyping = false;
                whisperTyping(false);
            }
            return;
        }

        typingWhisperTimeout = setTimeout(() => {
            if (!isWhisperingTyping) {
                isWhisperingTyping = true;
                whisperTyping(true);
            } else {
                whisperTyping(true);
            }

            scheduleStopTyping();
        }, 120);
    }

    function isTypingKey(event) {
        if (event.ctrlKey || event.metaKey || event.altKey) {
            return false;
        }

        const ignoredKeys = [
            'Shift',
            'CapsLock',
            'Tab',
            'Escape',
            'ArrowUp',
            'ArrowDown',
            'ArrowLeft',
            'ArrowRight',
            'Home',
            'End',
            'PageUp',
            'PageDown',
        ];

        return !ignoredKeys.includes(event.key);
    }

    function stopLocalTyping() {
        clearTimeout(typingWhisperTimeout);
        clearTimeout(stopTypingTimeout);

        if (isWhisperingTyping) {
            isWhisperingTyping = false;
            whisperTyping(false);
        }
    }

    if (chatForm) {
        chatForm.addEventListener('submit', async function(e) {
            e.preventDefault();

            const messageText = messageInput.value.trim();
            const hasFile = messageFile.files.length > 0;
            const hasSelectedMedia = Boolean(mediaUrlInput?.value);

            if (!messageText && !hasFile && !hasSelectedMedia) {
                return;
            }

            const formData = new FormData(chatForm);

            messageInput.disabled = true;
            messageFile.disabled = true;
            sendBtn.disabled = true;
            sendBtn.innerHTML = '<i class="fas fa-spinner fa-spin text-lg"></i>';

            try {
                const response = await fetch(chatForm.action, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    body: formData,
                });

                const data = await response.json();

                if (!response.ok || !data.success) {
                    throw new Error(data.error || 'Failed to send message.');
                }

                appendMessageBubble(
                    data.message.message,
                    data.message.time,
                    true,
                    data.message.id,
                    data.message.file
                );

                if (data.realtime === false) {
                    showTransientNotice('Message saved, but realtime delivery is offline right now.', 'warning');
                }

                stopLocalTyping();
                chatForm.reset();
                clearSelectedMediaState();
                messageInput.focus();
            } catch (error) {
                console.error('Error sending message:', error);
                showTransientNotice(error.message || 'Failed to send message.', 'error');
            } finally {
                messageInput.disabled = false;
                messageFile.disabled = false;
                sendBtn.disabled = false;
                sendBtn.innerHTML = '<i class="fas fa-paper-plane text-lg"></i>';
            }
        });
    }

    messageInput?.addEventListener('input', handleLocalTyping);
    messageInput?.addEventListener('blur', stopLocalTyping);
    messageInput?.addEventListener('keydown', (event) => {
        if (isTypingKey(event)) {
            handleLocalTyping();
        }

        if (event.key === 'Enter' && !event.shiftKey) {
            stopLocalTyping();
        }
    });
    emojiToggleBtn?.addEventListener('click', () => {
        if (emojiPickerPanel?.classList.contains('hidden')) {
            openPicker();
        } else {
            closePicker();
        }
    });

    emojiPickerClose?.addEventListener('click', closePicker);

    pickerTabButtons.forEach((button) => {
        button.addEventListener('click', () => {
            setActiveTab(button.dataset.tab);
        });
    });

    emojiChoices.forEach((button) => {
        button.addEventListener('click', () => {
            insertEmoji(button.dataset.emoji || '');
        });
    });

    mediaChoices.forEach((button) => {
        button.addEventListener('click', () => {
            selectMedia({
                url: button.dataset.mediaUrl || '',
                name: button.dataset.mediaName || 'Media',
                mime: button.dataset.mediaMime || 'image/gif',
                type: button.dataset.mediaType || 'media',
            });
        });
    });

    clearSelectedMedia?.addEventListener('click', clearSelectedMediaState);

    messageFile?.addEventListener('change', () => {
        if (messageFile.files.length > 0) {
            clearSelectedMediaState();
        }
    });

    document.addEventListener('click', (event) => {
        if (!emojiPickerPanel || !emojiToggleBtn) {
            return;
        }

        const target = event.target;
        if (!(target instanceof Node)) {
            return;
        }

        if (emojiPickerPanel.contains(target) || emojiToggleBtn.contains(target)) {
            return;
        }

        closePicker();
    });

    if (messagesContainer) {
        messagesContainer.addEventListener('submit', async function(e) {
            if (!e.target.classList.contains('delete-message-form')) {
                return;
            }

            e.preventDefault();

            const form = e.target;
            const msgId = form.getAttribute('data-msg-id');
            const formData = new FormData(form);

            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    body: formData,
                });

                const data = await response.json();

                if (data.success) {
                    document.getElementById('msg-container-' + msgId)?.remove();
                }
            } catch (error) {
                console.error('Error deleting message:', error);
            }
        });
    }

    if (window.Echo) {
        whisperChannel = window.Echo.private(conversationChannelName);

        whisperChannel
            .listenForWhisper('typing', (payload) => {
                if (Number(payload?.userId) !== Number(chatUserId)) {
                    return;
                }

                clearTimeout(typingIndicatorHideTimeout);

                if (payload?.typing) {
                    setTypingState(true, payload?.name || '{{ $user->name }}');
                    typingIndicatorHideTimeout = setTimeout(() => {
                        setTypingState(false);
                    }, 1800);
                } else {
                    setTypingState(false);
                }
            });

        window.Echo.private(`chat.${currentUserId}`)
            .listen('.message.sent', (e) => {
                if (Number(e.sender_id) !== Number(chatUserId)) {
                    return;
                }

                setTypingState(false);
                clearTimeout(typingIndicatorHideTimeout);

                if (document.getElementById(`msg-container-${e.id}`)) {
                    return;
                }

                appendMessageBubble(e.message, e.time, false, e.id, e.file);
            });
    }
});
</script>



</x-default-page>
