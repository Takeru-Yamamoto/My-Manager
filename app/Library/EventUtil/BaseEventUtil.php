<?php

namespace App\Library\EventUtil;

use App\Events as Event;

abstract class BaseEventUtil
{
    final private function event(string $method, $event): void
    {
        if (config("library.event.log")) {
            infoLog("");
            infoLog("=== EVENT " . $method . " PUBLISHING START ===");
            infoLog("");
        }

        try {
            if (config("library.event.log")) {
                if (method_exists($event, "parameters")) {
                    foreach ($event->parameters() as $key => $parameter) {
                        infoLog("EVENT PARAMS " . $key . ": " . json_encode($parameter, JSON_UNESCAPED_UNICODE));
                    }
                }
            }

            event($event);

            if (config("library.event.log")) infoLog("EVENT " . $method . " IS PUBLISHED");
        } catch (\Exception $e) {
            errorLog("EVENT " . $method . " PUBLISHING FAILURE");
            errorLog("ERROR: " . $e->getMessage());
        }

        if (config("library.event.log")) {
            infoLog("");
            infoLog("=== EVENT " . $method . " PUBLISHING END ===");
            infoLog("");
        }
    }

    final public function ScreenUpdateRequest(): void
    {
        $event = new Event\ScreenUpdateRequest();

        $this->event(__FUNCTION__, $event);
    }
}
