{{-- <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>talk</title>

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
        <p class="font-medium">Anjali</p>
        <p class="text-sm text-gray-500 truncate">hello...</p>
      </div>
      <span class="text-xs text-gray-400">4:00 PM</span>
    </div>

    <div class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-100 cursor-pointer transition">
      <img src="https://i.pravatar.cc/45?img=12" class="rounded-full">
      <div class="flex-1">
        <p class="font-medium">Jane</p>
        <p class="text-sm text-gray-500 truncate">are you home?</p>
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
          <p class="font-semibold">Anjali</p>
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
          Hey! what’s up?
        </div>
      </div>

      <div class="flex justify-end">
        <div class="bg-teal-500 text-white px-4 py-2 rounded-2xl max-w-md">
          Yeah.
        </div>
      </div>

      <div class="flex">
        <div class="bg-teal-100 px-4 py-2 rounded-2xl max-w-md">
          Are you sure? I don’t see it.
        </div>
      </div>

      <div class="flex justify-end">
        <div class="bg-teal-500 text-white px-4 py-2 rounded-2xl max-w-md">
          it’s not today.
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
</html> --}}

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Talk Chat App</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="h-screen w-screen bg-gray-100 overflow-hidden">

<div class="flex h-full">

  <!--SIDEBAR-->
  <aside class="w-1/4 bg-white border-r flex flex-col">

    <!--Logo-->
    <div class="p-5 flex items-center gap-3 bg-gradient-to-r from-teal-500 to-green-500 text-white">
      <img src="https://i.pinimg.com/1200x/7c/03/77/7c03777d88ee2dffef97e812961c7b3d.jpg" class="rounded w-8 h-12 object-contain">
      <h1 class="text-xl font-bold">Talk</h1>
    </div>

    <!--Search-->
    <div class="p-4">
      <input type="text" placeholder="Search"
        class="w-full px-4 py-2 rounded-full bg-gray-100 focus:ring-2 focus:ring-teal-400 outline-none">
    </div>

    <!--Chat List-->
    <div class="flex-1 overflow-y-auto p-3 space-y-2">

      <div class="chat-item flex items-center gap-3 p-3 rounded-xl bg-gray-200 cursor-pointer"
        data-chat="anjali">
        <img src="https://i.pravatar.cc/45?img=11" class="rounded-full">
        <div>
          <p class="font-medium">Heili</p>
          <p class="text-sm text-gray-500 truncate preview"></p>
        </div>
      </div>

      <div class="chat-item flex items-center gap-3 p-3 rounded-xl hover:bg-gray-100 cursor-pointer"
        data-chat="samip">
        <img src="https://i.pravatar.cc/45?img=12" class="rounded-full">
        <div>
          <p class="font-medium">Anjali</p>
          <p class="text-sm text-gray-500 truncate preview"></p>
        </div>
      </div>

    </div>
  </aside>

  <!--CHAT AREA-->
  <main class="flex-1 flex flex-col bg-gray-50">

    <!--Header-->
    <div class="p-4 bg-white border-b flex items-center gap-3">
      <img id="chatAvatar" class="rounded-full">
      <div>
        <p id="chatName" class="font-semibold"></p>
        <p class="text-xs text-green-500">Online</p>
      </div>
    </div>

    <!-- Message -->
    <div id="chatBox" class="flex-1 overflow-y-auto p-6 space-y-4">
      <p class="text-center text-xs text-gray-400">Today</p>
    </div>

    <!-- Input -->
    <div class="p-4 bg-white border-t flex items-center gap-3">
      <textarea id="messageInput" rows="1"
        placeholder="Type a message..."
        class="flex-1 resize-none px-4 py-2 rounded-full bg-gray-100 focus:ring-2 focus:ring-teal-400 outline-none"></textarea>

      <button id="sendBtn"
        class="px-5 py-2 bg-teal-500 text-white rounded-full hover:bg-teal-400 active:scale-95">
        Send
      </button>
    </div>

  </main>
</div>

<script>
const sendBtn = document.getElementById("sendBtn");
const input = document.getElementById("messageInput");
const chatBox = document.getElementById("chatBox");
const chatName = document.getElementById("chatName");
const chatAvatar = document.getElementById("chatAvatar");
const chatItems = document.querySelectorAll(".chat-item");

let currentChat = "anjali";
let editIndex = null;
let replyTo = null;

// Escape HTML
const escapeHTML = str => {
  const d = document.createElement("div");
  d.textContent = str;
  return d.innerHTML;
};

// LOAD
function loadMessages(chatId) {
  chatBox.innerHTML = `<p class="text-center text-xs text-gray-400">Today</p>`;
  const messages = JSON.parse(localStorage.getItem(chatId)) || [];

  messages.forEach((m, index) => {
    const wrap = document.createElement("div");
    wrap.className = m.sender === "me" ? "flex justify-end group" : "flex justify-start group";

    wrap.innerHTML = `
      <div class="relative ${m.sender === 'me'
        ? 'bg-teal-500 text-white'
        : 'bg-gray-200 text-gray-800'}
        px-4 py-2 rounded-2xl max-w-md">

        ${m.reply
          ? `<div class="text-xs mb-1 px-2 py-1 rounded bg-black/10">
               <span class="opacity-70">Reply:</span>
               ${escapeHTML(m.reply)}
             </div>`
          : ""}

        <p>${escapeHTML(m.text)}</p>

        <div class="flex justify-end items-center gap-2 mt-1 text-[10px] opacity-80">
          <span>${m.time}</span>
          ${m.sender === "me" ? `<span>${m.seen ? "✔✔" : "✔"}</span>` : ""}
        </div>

        <div class="absolute -right-7 top-2 hidden group-hover:flex flex-col gap-1">
          <button onclick="startReply('${chatId}', ${index})">↩️</button>
          ${m.sender === "me"
            ? `<button onclick="startEdit('${chatId}', ${index})">✏️</button>
               <button onclick="deleteMessage('${chatId}', ${index})">🗑️</button>`
            : ""}
        </div>
      </div>
    `;
    chatBox.appendChild(wrap);
  });

  chatBox.scrollTop = chatBox.scrollHeight;
  input.value = localStorage.getItem(chatId + "_draft") || "";
  clearUnread(chatId);
}

//  SAVE
function saveMessage(chatId, msg) {
  const msgs = JSON.parse(localStorage.getItem(chatId)) || [];
  msgs.push(msg);
  localStorage.setItem(chatId, JSON.stringify(msgs));
}

function updatePreview(chatId, text) {
  document.querySelector(`[data-chat="${chatId}"] .preview`).textContent = text;
}

// DELETE
function deleteMessage(chatId, index) {
  const msgs = JSON.parse(localStorage.getItem(chatId)) || [];
  msgs.splice(index, 1);
  localStorage.setItem(chatId, JSON.stringify(msgs));
  loadMessages(chatId);
}

//  EDIT
function startEdit(chatId, index) {
  const msgs = JSON.parse(localStorage.getItem(chatId));
  editIndex = index;
  input.value = msgs[index].text;
  input.focus();
}

// REPLY
function startReply(chatId, index) {
  const msgs = JSON.parse(localStorage.getItem(chatId));
  replyTo = msgs[index].text;
  showReplyPreview();
}

function showReplyPreview() {
  let preview = document.getElementById("replyPreview");
  if (!preview) {
    preview = document.createElement("div");
    preview.id = "replyPreview";
    preview.className =
      "px-4 py-2 text-sm bg-gray-200 flex justify-between items-center";
    preview.innerHTML = `
      <span id="replyText"></span>
      <button onclick="cancelReply()">✖</button>
    `;
    input.parentElement.prepend(preview);
  }
  document.getElementById("replyText").textContent = replyTo;
}

function cancelReply() {
  replyTo = null;
  document.getElementById("replyPreview")?.remove();
}

// UNREAD + SEEN
function addUnread(chatId) {
  if (chatId === currentChat) return;
  const item = document.querySelector(`[data-chat="${chatId}"]`);
  let badge = item.querySelector(".badge");

  if (!badge) {
    badge = document.createElement("span");
    badge.className =
      "badge ml-auto bg-red-500 text-white text-xs px-2 py-0.5 rounded-full";
    badge.textContent = "1";
    item.appendChild(badge);
  } else {
    badge.textContent = Number(badge.textContent) + 1;
  }
}

function clearUnread(chatId) {
  document
    .querySelector(`[data-chat="${chatId}"]`)
    ?.querySelector(".badge")
    ?.remove();

  const msgs = JSON.parse(localStorage.getItem(chatId)) || [];
  msgs.forEach(m => {
    if (m.sender === "me") m.seen = true;
  });
  localStorage.setItem(chatId, JSON.stringify(msgs));
}

// SEND
function sendMessage() {
  const text = input.value.trim();
  if (!text) return;

  const msgs = JSON.parse(localStorage.getItem(currentChat)) || [];

  if (editIndex !== null) {
    msgs[editIndex].text = text;
    localStorage.setItem(currentChat, JSON.stringify(msgs));
    editIndex = null;
  } else {
    saveMessage(currentChat, {
      text,
      sender: "me",
      seen: false,
      reply: replyTo,
      time: new Date().toLocaleTimeString([], { hour: "2-digit", minute: "2-digit" })
    });

    updatePreview(currentChat, text);
    setTimeout(() => autoReply(currentChat), 1500);
  }

  cancelReply();
  input.value = "";
  localStorage.removeItem(currentChat + "_draft");
  loadMessages(currentChat);
}

// AUTO REPLY
function autoReply(chatId) {
  const replies = ["Okay 👍", "Noted", "Sure 😊", "Got it!", "Alright 👌"];
  const reply = replies[Math.floor(Math.random() * replies.length)];

  saveMessage(chatId, {
    text: reply,
    sender: "them",
    seen: true,
    time: new Date().toLocaleTimeString([], { hour: "2-digit", minute: "2-digit" })
  });

  updatePreview(chatId, reply);
  addUnread(chatId);

  if (chatId === currentChat) loadMessages(chatId);
}

//  EVENTS
input.addEventListener("input", () => {
  localStorage.setItem(currentChat + "_draft", input.value);
});

input.addEventListener("keydown", e => {
  if (e.key === "Enter" && !e.shiftKey) {
    e.preventDefault();
    sendMessage();
  }
});

sendBtn.onclick = sendMessage;

// Switch Chat
chatItems.forEach(item => {
  item.onclick = () => {
    chatItems.forEach(i => i.classList.remove("bg-gray-200"));
    item.classList.add("bg-gray-200");

    currentChat = item.dataset.chat;
    chatName.textContent = item.querySelector(".font-medium").textContent;
    chatAvatar.src = item.querySelector("img").src;

    loadMessages(currentChat);
  };
});

// Initial Open
document.querySelector('[data-chat="anjali"]').click();
</script>



</body>
</html>
