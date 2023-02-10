<?php

namespace App;


use App\Component\Container;
use App\Component\ControllerHandler;
use App\Component\DatabaseConnection;
use App\Component\Http\JsonResponse;
use App\Component\Http\Request;
use App\Component\ResponseHandler;

/**
 * Class Application
 */
readonly class Application
{
    /**
     * @param array $config
     */
    public function __construct(private array $config) {}

    public function run(): void
    {
        $containerMap = [
            DatabaseConnection::class => new DatabaseConnection($this->config['db']),
            Request::class => new Request()
        ];

        $container = new Container($containerMap);
        $handler = new ControllerHandler($this->config['routes'] ?? [], $container);
        $response = $handler->handle();

        if ($response === null) {
            $response = new JsonResponse('');
        }

        (new ResponseHandler($response))->handle();
    }
}
