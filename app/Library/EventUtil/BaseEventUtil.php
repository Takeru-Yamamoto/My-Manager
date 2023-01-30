<?php

namespace App\Library\EventUtil;

use App\Events as Event;

abstract class BaseEventUtil
{
    final private function event(string $method, $event): void
    {
        if (config("access.event")) {
            infoLog("");
            infoLog("=== EVENT " . $method . " PUBLISHING START ===");
            infoLog("");

            try {
                if (method_exists($event, "parameters")) {
                    foreach ($event->parameters() as $key => $parameter) {
                        infoLog("EVENT PARAMS " . $key . ": " . json_encode($parameter, JSON_UNESCAPED_UNICODE));
                    }
                }

                event($event);
                infoLog("EVENT " . $method . " IS PUBLISHED");
            } catch (\Exception $e) {
                infoLog("EVENT " . $method . " PUBLISHING FAILURE");
                infoLog("ERROR: " . $e->getMessage());
            }

            infoLog("");
            infoLog("=== EVENT " . $method . " PUBLISHING END ===");
            infoLog("");
        } else {
            event($event);
        }
    }

    final public function ScreenUpdateRequest(): void
    {
        $event = new Event\ScreenUpdateRequest();

        $this->event(__FUNCTION__, $event);
    }
}
