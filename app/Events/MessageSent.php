<?php

namespace App\Events;

use App\Models\ChatMessage;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var ChatMessage
     */
    public $message;
    public $userId;
    public $identifier;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message, $identifier)
    {
        $this->message = $message;
//        $this->userId = $userId;
        $this->identifier = $identifier;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel
     */
    public function broadcastOn(): Channel
    {

        return new Channel('mibsoftClientChat.' . $this->identifier);
    }

    public function broadcastAs(): string
    {
        return 'MessageSent';
    }

    public function broadcastWith(): array
    {
        return [
            'message' => $this->message,
            'identifier' => $this->identifier
        ];
    }

}
