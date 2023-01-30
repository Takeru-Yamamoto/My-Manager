<?php

namespace App\Library\APIUtil;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;

abstract class BaseAPIUtil
{
    private string $url;
    private array $params;
    private Http $http;
    private Response $response;
    private string $errorMessage;
    private string $successMessage;

    private bool $isReceivedResponse;
    private bool $hasError;

    private const ERROR_MESSAGE = "通信に失敗しました。";
    private const SUCCESS_MESSAGE = "通信に成功しました。";

    function __construct(string $url, array $params = array())
    {
        $this->http   = new Http;
        $this->url    = $url;
        $this->params = $params;
        $this->setErrorMessage(self::ERROR_MESSAGE);
        $this->setSuccessMessage(self::SUCCESS_MESSAGE);

        $this->isReceivedResponse = false;
        $this->hasError          = false;
    }

    final public function withBasic(string $userName, string $password): self
    {
        $this->http = $this->http->withBasicAuth($userName, $password);
        return $this;
    }

    final public function withDigest(string $userName, string $password): self
    {
        $this->http = $this->http->withDigestAuth($userName, $password);
        return $this;
    }

    final public function withToken(string $token): self
    {
        $this->http = $this->http->withToken($token);
        return $this;
    }

    final public function asForm(): self
    {
        $this->http = $this->http->asForm();
        return $this;
    }

    final public function withHeaders(array $headers): self
    {
        $this->http = $this->http->withHeaders($headers);
        return $this;
    }

    final public function acceptJson(): self
    {
        $this->http = $this->http->acceptJson();
        return $this;
    }

    final public function setTomeout(int $second): self
    {
        $this->http = $this->http->timeout($second);
        return $this;
    }

    final public function get(): self
    {
        emphasisLogStart("API CONNECT");
        $this->response = $this->http::get($this->url, $this->params);
        return $this->isFailure();
    }

    final public function post(): self
    {
        emphasisLogStart("API CONNECT");
        $this->response = $this->http::post($this->url, $this->params);
        return $this->isFailure();
    }

    final public function put(): self
    {
        emphasisLogStart("API CONNECT");
        $this->response = $this->http::put($this->url, $this->params);
        return $this->isFailure();
    }

    final public function delete(): self
    {
        emphasisLogStart("API CONNECT");
        $this->response = $this->http::delete($this->url, $this->params);
        return $this->isFailure();
    }

    final public function status(): ?int
    {
        if (!$this->isReceived() || $this->hasError()) return null;

        return $this->response->status();

    }

    final public function header(string $key): ?string
    {
        if (!$this->isReceived() || $this->hasError()) return null;

        return $this->response->header($key);
    }

    final public function headers(): ?array
    {
        if (!$this->isReceived() || $this->hasError()) return null;

        return $this->response->headers();
    }

    final public function body(): ?string
    {
        if (!$this->isReceived() || $this->hasError()) return null;

        return $this->response->body();
    }

    final public function json(?string $key): mixed
    {
        if (!$this->isReceived() || $this->hasError()) return null;

        return $this->response->json($key);
    }

    final public function setErrorMessage(string $errorMessage): void
    {
        $this->errorMessage = $errorMessage;
    }

    final public function setSuccessMessage(string $successMessage): void
    {
        $this->successMessage = $successMessage;
    }

    final private function isFailure(): self
    {
        $this->isReceivedResponse = true;

        $this->hasError = $this->response->clientError();

        if ($this->hasError()) return $this->failureLog();

        return $this->successLog();
    }

    final private function isReceived(): bool
    {
        return $this->isReceivedResponse;
    }

    final private function hasError(): bool
    {
        return $this->hasError;
    }

    final private function successLog(): self
    {
        emptyLog();
        infoLog($this->successMessage);
        infoLog("body: " . $this->response->body());
        infoLog("param: " . json_encode($this->params, JSON_UNESCAPED_UNICODE));
        emptyLog();
        emphasisLogEnd("API");

        return $this;
    }

    final private function failureLog(): self
    {
        emptyLog();
        infoLog($this->errorMessage);
        infoLog("response: " . $this->response);
        infoLog("param: " . json_encode($this->params, JSON_UNESCAPED_UNICODE));
        emptyLog();
        emphasisLogEnd("API");

        return $this;
    }
}
