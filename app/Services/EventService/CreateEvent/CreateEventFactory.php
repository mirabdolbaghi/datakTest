<?php

namespace App\Services\EventService\CreateEvent;


use App\Event;

class CreateEventFactory
{
    public function getEvent(): Event
    {
        return new Event();
    }
}
