<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ItemCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Item $item)
    {
     //
     $calendarId = env('GOOGLE_CALENDAR_ID');
     $event = new \Google_Service_Calendar_Event([
     'summary' => $item->summary,
     'location' => $item->location,
     'description' => $item->description,
     'start' => [
       'dateTime' => $item->date_start,
       'timeZone' => 'Asia/Tokyo',
     ],
     'end' => [
       'dateTime' => $item->date_end,
       'timeZone' => 'Asia/Tokyo',
     ]
   ]);
   $service->events->insert($calendarId, $event);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
