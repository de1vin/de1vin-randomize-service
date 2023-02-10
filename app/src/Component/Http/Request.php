<?php

namespace App\Component\Http;

/**
 * Class Request
 *
 * Implementation outside of PSR
 */
class Request
{
    private string $path;
    private array $query;

    public function __construct() {
        $this->init();
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $key
     *
     * @param mixed|null $default
     *
     * @return mixed
     */
    public function getQuery(string $key, mixed $default = null): mixed
    {
        return $this->query[$key] ?? $default;
    }

    /**
     * @return array
     */
    public function getAllQuery(): array
    {
        return $this->query;
    }

    private function init(): void
    {
        $this->path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $query = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
        parse_str($query, $result);
        $this->query = $result;
    }
}
