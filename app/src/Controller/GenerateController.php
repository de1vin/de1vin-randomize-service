<?php

namespace App\Controller;


use App\Component\Http\JsonResponse;
use App\Service\NumberService;

/**
 * Class GenerateController
 */
readonly class GenerateController
{
    /**
     * @param NumberService $numberService
     */
    public function __construct(private NumberService $numberService)
    {}

    /**
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $data = $this->numberService->createRandom();

        return new JsonResponse($data);
    }
}
