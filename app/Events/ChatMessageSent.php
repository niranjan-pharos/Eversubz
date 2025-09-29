<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;


    class ChatMessageSent implements ShouldBroadcast
    {
        use Dispatchable, InteractsWithSockets, SerializesModels;

        public $message;
        public $user;
        public $receiver;

        

        /**
         * Create a new event instance.
         *
         * @return void
         */
        public function __construct($message, $user, $receiver)
        {
            $this->message = $message;
            $this->user = $user;
            $this->receiver = $receiver;
        }

        /**
         * Get the channels the event should broadcast on.
         *
         * @return array<int, \Illuminate\Broadcasting\Channel>
         */
        public function broadcastOn()
        {
            return [new Channel('chat.'. $this->receiver->id)];
        }
    }
