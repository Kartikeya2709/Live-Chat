<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    

    /**
     * Create a new event instance.
     *
     * 
     * @param string $message
     * @return void
     */
    public function __construct( string $message)
    {
        
      
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('chat');  // Broadcasting to the "chat" channel
    }

    /**
     * Define the data to broadcast.
     * 
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'message' => $this->message
          
        ];
    }
}
