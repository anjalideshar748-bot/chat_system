<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\Message;
use App\Models\User;
use App\Support\AttachmentCompression;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Str;






class userController extends Controller
{
    //send friend request
    public function friendRequestView(){
        $friend = Friend::where('friend_id',Auth::User()->id)->where('status','pending')->get();
        $user = $friend->map(function($friend){
            return User::find($friend->user_id);

        });
        return view("FriendRequest",compact('friend','user'));
    }

    public function FriendRequestSend($user_id,$friend_id){
        $friend = new friend();
        $friend->user_id=$user_id;
        $friend->friend_id=$friend_id;
        $friend->status='pending';
        $friend->save();
        return redirect()->back()->with('success', 'Friend request sent');
    }

    // request accept
    public function requestAccept($friend_id, $user_id){
        $friend = Friend::where('friend_id',$friend_id)->where('user_id',$user_id)->first();
        $friend->status='accepted';
        $friend->save();
        return redirect()->back();

    }
public function reject($friend_id)
{
    $deleted = Friend::where(function ($query) use ($friend_id) {
            $query->where('user_id', Auth::id())
                  ->where('friend_id', $friend_id);
        })
        ->orWhere(function ($query) use ($friend_id) {
            $query->where('user_id', $friend_id)
                  ->where('friend_id', Auth::id());
        })
        ->where('status', 'pending')
        ->delete();

    if ($deleted === 0) {
        return back()->with('error', 'Friend request not found or already processed.');
    }

    return back()->with('success', 'Friend request rejected.');
}

    //chat area



   public function show($id)
{
    $user = User::findOrFail($id);

    $messages = Message::where(function($q) use ($id) {
            $q->where('sender_id', Auth::id())
              ->where('receiver_id', $id);
        })
        ->orWhere(function($q) use ($id) {
            $q->where('sender_id', $id)
              ->where('receiver_id', Auth::id());
        })
        ->orderBy('created_at')
        ->get();

    return view('chat-area', compact('user','messages'));
}

public function attachment(Message $message, Request $request)
{
    abort_unless(
        in_array(Auth::id(), [$message->sender_id, $message->receiver_id], true),
        403
    );

    $fileMeta = $message->file_meta;

    if (! $fileMeta || empty($fileMeta['storage_path'])) {
        abort(404);
    }

    $absolutePath = storage_path('app/' . ltrim($fileMeta['storage_path'], '/'));

    if (! File::exists($absolutePath)) {
        abort(404);
    }

    $storedContents = File::get($absolutePath);
    $originalContents = AttachmentCompression::decompress($storedContents, $fileMeta['compression'] ?? null);
    $disposition = $request->boolean('download') ? 'attachment' : 'inline';

    return response($originalContents, 200, [
        'Content-Type' => $fileMeta['mime'] ?? 'application/octet-stream',
        'Content-Length' => strlen($originalContents),
        'Content-Disposition' => $disposition . '; filename="' . addslashes($fileMeta['name'] ?? 'attachment') . '"',
        'Cache-Control' => 'private, max-age=0, must-revalidate',
    ]);
}
//     public function sendMessage(Request $request)
// {
//     $request->validate([
//         'message'     => 'required|string|max:5000',
//         'receiver_id' => 'required|exists:users,id',
//     ]);

//     $sender = Auth::user();
//     $receiver = User::findOrFail($request->receiver_id);

//     // Ensure both users have RSA keys generated
//     $sender->generateRsaKeys();
//     $receiver->generateRsaKeys();

//     // Since RSA cannot directly encrypt long strings (like longText messages),
//     // we generate an AES key, encrypt the message with it, and then use RSA
//     // to encrypt the AES key. (Hybrid RSA Encryption)
//     $aesKey = openssl_random_pseudo_bytes(32);
//     $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('AES-256-CBC'));

//     $encryptedMessage = openssl_encrypt($request->message, 'AES-256-CBC', $aesKey, 0, $iv);

//     // Write RSA code in backend: encrypting the AES key with RSA Public Keys
//     openssl_public_encrypt($aesKey, $encryptedKeySender, $sender->public_key);
//     openssl_public_encrypt($aesKey, $encryptedKeyReceiver, $receiver->public_key);

//     $message = Message::create([
//         'sender_id'              => $sender->id,
//         'receiver_id'            => $receiver->id,
//         'encrypted_message'      => base64_encode($encryptedMessage),
//         'file'                   => $request->file ? base64_encode(file_get_contents($request->file)) : null,
//         'encrypted_key_sender'   => base64_encode($encryptedKeySender),
//         'encrypted_key_receiver' => base64_encode($encryptedKeyReceiver),
//         'iv'                     => base64_encode($iv),
//     ]);

//     if ($request->wantsJson() || $request->ajax()) {
//         return response()->json([
//             'success' => true,
//             'message' => [
//                 'id'      => $message->id,
//                 'message' => $request->message,
//                 'time'    => $message->created_at->format('H:i'),
//             ],
//             // Sending back keys so they can be shown as requested
//             'encryption_key' => $receiver->public_key,
//             'decryption_key' => $receiver->private_key
//         ]);
//     }

//     return back();
// }

public function sendMessage(Request $request)
{
    $request->validate([
        'message'     => 'nullable|string|max:5000',
        'receiver_id' => 'required|exists:users,id',
        'file'        => 'nullable|file|max:5120',
        'media_url'   => 'nullable|url|max:2048',
        'media_name'  => 'nullable|string|max:255',
        'media_mime'  => 'nullable|string|max:100',
    ]);

    if (!$request->filled('message') && !$request->hasFile('file') && !$request->filled('media_url')) {
        return response()->json([
            'success' => false,
            'error' => 'Message or file is required.',
        ], 422);
    }

    $sender = Auth::user();
    $receiver = User::findOrFail($request->receiver_id);

    $sender->generateRsaKeys();
    $receiver->generateRsaKeys();

    $aesKey = openssl_random_pseudo_bytes(32);
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('AES-256-CBC'));

    $plainMessage = (string) $request->input('message', '');
    $encryptedMessage = openssl_encrypt($plainMessage, 'AES-256-CBC', $aesKey, 0, $iv);

    openssl_public_encrypt($aesKey, $encryptedKeySender, $sender->public_key);
    openssl_public_encrypt($aesKey, $encryptedKeyReceiver, $receiver->public_key);

    $filePayload = null;

    if ($request->hasFile('file')) {
        $uploadedFile = $request->file('file');
        $directory = storage_path('app/chat-files-compressed');
        File::ensureDirectoryExists($directory);

        $originalName = $uploadedFile->getClientOriginalName();
        $mimeType = $uploadedFile->getClientMimeType() ?: 'application/octet-stream';
        $originalContents = File::get($uploadedFile->getRealPath());
        $compressedFile = AttachmentCompression::compress($originalContents);
        $extension = $uploadedFile->getClientOriginalExtension();
        $storedFileName = Str::uuid()->toString() . ($extension ? '.' . $extension : '') . '.bin';
        File::put($directory . DIRECTORY_SEPARATOR . $storedFileName, $compressedFile['contents']);

        $filePayload = json_encode([
            'name' => $originalName,
            'mime' => $mimeType,
            'size' => $compressedFile['original_size'],
            'compressed_size' => $compressedFile['stored_size'],
            'compression' => $compressedFile['algorithm'],
            'storage_path' => 'chat-files-compressed/' . $storedFileName,
        ]);
    } elseif ($request->filled('media_url')) {
        $filePayload = json_encode([
            'url' => $request->string('media_url')->toString(),
            'name' => $request->string('media_name')->toString() ?: 'Media',
            'mime' => $request->string('media_mime')->toString() ?: 'image/gif',
            'size' => null,
        ]);
    }

    $messagePayload = [
        'sender_id'              => $sender->id,
        'receiver_id'            => $receiver->id,
        'encrypted_message'      => base64_encode($encryptedMessage),
        'encrypted_key_sender'   => base64_encode($encryptedKeySender),
        'encrypted_key_receiver' => base64_encode($encryptedKeyReceiver),
        'iv'                     => base64_encode($iv),
        'file'                   => $filePayload,
    ];

    $message = Message::create($messagePayload);

    $message->load('sender');

    $realtimeDelivered = true;

    try {
        broadcast(new \App\Events\MessageSent($message))->toOthers();
    } catch (\Throwable $e) {
        $realtimeDelivered = false;
        Log::warning('Message broadcast failed', [
            'message_id' => $message->id,
            'receiver_id' => $receiver->id,
            'error' => $e->getMessage(),
        ]);
    }

    if ($request->wantsJson() || $request->ajax()) {
        return response()->json([
            'success' => true,
            'realtime' => $realtimeDelivered,
            'message' => [
                'id'      => $message->id,
                'message' => $message->message,
                'file'    => $message->file_meta,
                'time'    => $message->created_at->format('H:i'),
            ]
        ]);
    }

    return back();
}
public function delete($id, Request $request)
{
    $message = Message::findOrFail($id);

    if ($message->sender_id != Auth::id()) {
        if ($request->wantsJson() || $request->ajax()) return response()->json(['error' => 'Unauthorized'], 403);
        abort(403);
    }

    $fileMeta = $message->file_meta;
    if ($fileMeta) {
        if (!empty($fileMeta['storage_path'])) {
            $absolutePath = storage_path('app/' . $fileMeta['storage_path']);
            if (File::exists($absolutePath)) {
                File::delete($absolutePath);
            }
        } elseif (!empty($fileMeta['path'])) {
            $legacyPath = public_path($fileMeta['path']);
            if (File::exists($legacyPath)) {
                File::delete($legacyPath);
            }
        }
    }

    $message->delete();

    if ($request->wantsJson() || $request->ajax()) {
        return response()->json(['success' => true]);
    }

    return back();
}

}
