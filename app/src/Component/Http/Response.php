<?php

namespace App\Component\Http;


/**
 * Class Response
 *
 * Implementation outside of PSR
 */
class Response
{
    protected array $headers = [];
    protected mixed $content;
    protected int $statusCode;

    /**
     * @param mixed $content
     * @param array $headers
     * @param int   $statusCode
     */
    public function __construct(mixed $content, int $statusCode = 200, array $headers = [])
    {
        $this->content = $content;
        $this->headers = array_merge($this->headers, $headers);
        $this->statusCode = $statusCode;
    }

    /**
     * @param string $key
     * @param string $value
     */
    public function setHeader(string $key, string $value): void
    {
        $this->headers[$key] = $value;
    }

    /**
     * @param array $headers
     */
    public function setHeaders(array $headers): void
    {
        $this->headers = $headers;
    }

    /**
     * @param string $key
     *
     * @return string
     */
    public function getHeader(string $key): string
    {
        return $this->headers[$key];
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @return mixed
     */
    public function getContent(): string
    {
        return (string)$this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent(mixed $content): void
    {
        $this->content = $content;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     */
    public function setStatusCode(int $statusCode): void
    {
        $this->statusCode = $statusCode;
    }
}
