<?php

namespace App\Events;
use App\OrderPizza;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderStatusChanged implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $order;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(OrderPizza $order)
    {
        $this->order = $order;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // return new Channel('pizza-tracker.'.$this->order->id);
        return ['pizza-tracker.'.$this->order->id, 'pizza-tracker'];
    }

    public function broadcastWith() {
        $extra = [
            'status_name' => $this->order->status->name,
            'status_percent' => $this->order->status->percent,
        ];

        return array_merge($this->order->toArray(), $extra);
    }
}
