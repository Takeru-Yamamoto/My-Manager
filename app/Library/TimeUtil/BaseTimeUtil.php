<?php

namespace App\Library\TimeUtil;

abstract class BaseTimeUtil
{
    private string $method;
    private string $process;

    private float $methodTime;
    private float $methodStart;
    private float $methodStop;
    private float $processTime;
    private float $processStart;
    private float $processStop;

    function __construct(string $method)
    {
        $this->method = $method;

        emphasisLogStart("METHOD " . $this->method);

        $this->methodStart = microtime(true);
    }

    function __destruct()
    {
        $this->methodStop = microtime(true);
        $this->methodTime = $this->methodStop - $this->methodStart;

        emptyLog();
        infoLog("TIME : " . $this->methodTime . " SECONDS");
        emphasisLogEnd("METHOD " . $this->method);
    }

    final public function start(?string $process): void
    {
        $this->process = $process;

        littleEmphasisLogStart("PROCESS " . $this->process);

        $this->processStart = microtime(true);
    }

    final public function stop(): float
    {
        $this->processStop = microtime(true);
        $this->processTime = $this->processStop - $this->processStart;
        emptyLog();
        infoLog("TIME : " . $this->processTime . " SECONDS");
        littleEmphasisLogEnd("PROCESS " . $this->process);

        return $this->processTime;
    }
}
