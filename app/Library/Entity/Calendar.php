<?php

namespace App\Library\Entity;

class Calendar
{
    public int $id;
    public string $eventDate;
    public string $eventText;
    public ?string $eventUrl;
    public ?string $eventClass;

    public function __construct(int $id, string $eventDate, string $eventText, string $eventUrl = null, string $eventClass = null)
    {
        $this->id         = $id;
        $this->eventDate  = $eventDate;
        $this->eventText  = $eventText;
        $this->eventUrl   = $eventUrl;
        $this->eventClass = $eventClass;
    }
}
