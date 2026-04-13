<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Message $message;
    public string  $plainText;
    public int     $senderId;

    /**
     * @param  Message  $message   The persisted message model.
     * @param  string   $plainText The original (unencrypted) message text so the
     *                             receiver can display it without client-side decryption.
     */
    public function __construct(Message $message, string $plainText)
    {
        $this->message   = $message;
        $this->plainText = $plainText;
        $this->senderId  = $message->sender_id;
    }

    /**
     * Broadcast on the private channel of the receiver so only they hear it.
     */
    public function broadcastOn(): Channel
    {
        return new PrivateChannel('chat.' . $this->message->receiver_id);
    }

    /**
     * The payload sent to the client.
     */
    public function broadcastWith(): array
    {
        return [
            'id'        => $this->message->id,
            'message'   => $this->plainText,
            'sender_id' => $this->message->sender_id,
            'time'      => $this->message->created_at->format('H:i'),
        ];
    }

    /**
     * Use a simple event name without namespacing.
     */
    public function broadcastAs(): string
    {
        return 'MessageSent';
    }
}
