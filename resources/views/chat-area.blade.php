<x-default-page>
    <!-- Active Chat -->
    <div id="activeChatPanel" class="flex-1 flex flex-col h-full">
        <!-- Chat Header -->
        <div class="bg-white border-b border-teal-100 px-6 py-4 flex items-center gap-4 shadow-sm z-10">
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
            <div class="flex-1">
                <h2 id="chatUserName" class="font-bold text-xl text-gray-800">{{ $user->name }}</h2>
                <div id="chatUserStatus" class="text-sm {{ $user->is_online ? 'text-emerald-600' : 'text-gray-500' }} flex items-center gap-1.5 font-medium">
                    <i class="fas fa-circle text-[8px]"></i>
                    {{ $user->is_online ? 'Online now' : 'Offline' }}
                </div>
            </div>
            <a href="{{ route('dashboard') }}" class="md:hidden text-teal-500 hover:text-teal-700 bg-teal-50 p-2 rounded-xl">
                <i class="fas fa-arrow-left text-xl"></i>
            </a>
        </div>

        <!-- Messages -->
        <div id="messagesContainer" class="flex-1 overflow-y-auto p-6 space-y-4 messages-container bg-[#f8fafc]">
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
                            
                            <div class="max-w-[75%] bg-gradient-to-br from-teal-600 to-teal-700 text-white px-5 py-3 rounded-3xl rounded-br-none shadow-md">
                                <p class="leading-relaxed">{{ $msg->message }}</p>
                                <span class="text-teal-100 text-[10px] block text-right mt-1 opacity-80">{{ $msg->created_at->format('H:i') }}</span>
                            </div>
                        </div>
                    @else
                        <!-- RECEIVED MESSAGE -->
                        <div class="flex justify-start message-bubble">
                            <div class="max-w-[75%] bg-white border border-teal-100 px-5 py-3 rounded-3xl rounded-bl-none shadow-sm">
                                <p class="text-gray-800 leading-relaxed">{{ $msg->message }}</p>
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
        <div class="bg-white border-t border-teal-100 p-4 md:p-5 z-10">
            <form id="chatForm" method="post" action="{{ route('message.send') }}" class="flex gap-3">
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
            </form>
        </div>
    </div>

    <!-- AJAX Chat Interaction Logic -->
    <script>
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
    </script>
</x-default-page>
