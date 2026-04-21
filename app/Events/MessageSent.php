<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct(Message $message)
    {
        $message->loadMissing('sender');
        $this->message = $message;
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('chat.' . $this->message->receiver_id),
        ];
    }

    public function broadcastAs(): string
    {
        return 'message.sent';
    }

    public function broadcastWith(): array
    {
        return [
            'id'         => $this->message->id,
            'sender_id'  => $this->message->sender_id,
            'receiver_id'=> $this->message->receiver_id,
            'message'    => $this->message->message,
            'file'       => $this->message->file_meta,
            'iv'         => $this->message->iv,
            'time'       => $this->message->created_at->format('H:i'),
            'sender_name'=> $this->message->sender->name ?? 'Someone',
        ];
    }
}
