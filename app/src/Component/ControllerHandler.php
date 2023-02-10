<?php

namespace App\Component;


use App\Component\Http\JsonResponse;
use App\Component\Http\Request;
use App\Component\Http\Response;
use App\Exception\HttpException;
use Exception;

/**
 * Class ControllerHandler
 */
readonly class ControllerHandler
{
    public function __construct(
        private array     $routes,
        private Container $container
    ) {}

    /**
     * @return Response|null
     *
     * @throws
     */
    public function handle(): ?Response
    {
        try {
            /** @var Request $request */
            $request = $this->container->get(Request::class);
            $currentPath = trim($request->getPath(), '/');
            $pathConfig = $this->findConfigInRoutes($currentPath);
            $controllerMethod = null;

            if ($pathConfig) {
                $controllerClass = $pathConfig[0];
                $controllerMethod = $pathConfig[1] ?? null;
            } else {
                $controllerClass = sprintf('App\Controller\%sController', ucfirst($currentPath));
            }

            $response = $this->execute($controllerClass, $controllerMethod);
        } catch (Exception $exception) {
            $response = new JsonResponse(['error' =>$exception->getMessage()], 500);

            if ($exception instanceof HttpException) {
                $response->setStatusCode($exception->getErrorCode());
            }
        }

        return $response;
    }

    /**
     * @param string|null $controllerClass
     * @param string|null $controllerMethod
     *
     * @return Response|null
     *
     * @throws
     */
    private function execute(string|null $controllerClass, string|null $controllerMethod): ?Response
    {
        if (!class_exists($controllerClass)) {
            throw new HttpException(404, 'Not found');
        }

        $controller = $this->container->get($controllerClass);

        if ($controllerMethod) {
            $result = $controller->$controllerMethod();
        } else {
            $result = $controller();
        }

        return $result;
    }

    /**
     * @param string $path
     * @return array|null
     */
    private function findConfigInRoutes(string $path): ?array
    {
        $config = null;

        foreach ($this->routes as $route => $routeConfig) {
            if (trim($route, '/') === $path) {
                $config = (array)$routeConfig;
                break;
            }
        }

        return $config;
    }
}
