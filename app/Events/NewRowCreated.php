<?php

namespace App\Events;

use App\Models\Row;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewRowCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private Row $row;

    /**
     * Create a new event instance.
     */
    public function __construct(Row $row)
    {
        $this->row = $row;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            "first"
        ];
    }
}
