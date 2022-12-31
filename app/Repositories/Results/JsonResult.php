<?php

namespace App\Repositories\Results;

abstract class JsonResult implements \JsonSerializable
{
    public function jsonSerialize(): array
    {
        return ['result' => $this->removeNullValues(get_object_vars($this))];
    }

    protected function removeNullValues($responses)
    {
        $result = (is_array($responses) ? array() : new \stdClass());

        foreach ($responses as $key => $value) {
            if (is_array($value) || is_object($value)) {
                if (is_object($result)) {
                    $result->$key = $this->removeNullValues($value);
                } else {
                    $result[$key] = $this->removeNullValues($value);
                }
            } elseif (!is_null($value)) {
                if (is_object($result)) {
                    $result->$key = $value;
                } else {
                    $result[$key] = $value;
                }
            }
        }

        return $result;
    }
}
