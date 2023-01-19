<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Consts\NameConst;

trait BaseModel
{
    public function isValid(): bool
    {
        assert($this instanceof Model);
        return isset($this->is_valid) ? $this->is_valid : false;
    }

    private function safeSave(string $message): void
    {
        assert($this instanceof Model);
        Transaction($message, function () {
            $this->save();
        });
    }

    private function createMessage(string $name): string
    {
        $className = className($this);
        $crud = isset(NameConst::NAMES[NameConst::TYPE_SHORT][$name]) ? NameConst::NAMES[NameConst::TYPE_SHORT][$name] : $name;

        $backtrace = debug_backtrace();
        $targetBacktrace = isset($backtrace[1]) ? $backtrace[1] : null;

        if (is_null($targetBacktrace) || !isset($targetBacktrace["file"]) || !isset($targetBacktrace["line"])) return $className . " " . $crud . " backtrace: " . json_encode($backtrace);

        $service = explode("/", $targetBacktrace["file"]);
        $serviceClassName = str_replace(".php", "", end($service));
        $line = $targetBacktrace["line"];

        return $className . " " . $crud . " in " . $serviceClassName . ": " . $line;
    }

    public function safeCreate(): void
    {
        $this->safeSave($this->createMessage(NameConst::CREATE));
    }

    public function safeUpdate(): void
    {
        $this->safeSave($this->createMessage(NameConst::UPDATE));
    }

    public function safeDelete(): void
    {
        assert($this instanceof Model);
        Transaction($this->createMessage(NameConst::DELETE), function () {
            $this->delete();
        });
    }

    public function changeIsValid(int $isValid): void
    {
        assert($this instanceof Model);
        if (isset($this->is_valid)) {
            $this->is_valid = $isValid;
            $this->safeSave($this->createMessage(NameConst::CHANGE));
        }
    }
}
