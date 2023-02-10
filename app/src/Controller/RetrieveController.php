<?php

namespace App\Controller;


use App\Component\Http\JsonResponse;
use App\Component\Http\Request;
use App\Exception\HttpException;
use App\Service\NumberService;

/**
 * Class GenerateController
 */
readonly class RetrieveController
{
    /**
     * @param NumberService $numberService
     * @param Request       $request
     */
    public function __construct(private NumberService $numberService, private Request $request)
    {}

    /**
     * @return JsonResponse
     *
     * @throws
     */
    public function __invoke(): JsonResponse
    {
        $id = $this->request->getQuery('id');

        if (empty($id)) {
            throw new HttpException(400, 'Parameter "id" must be set.');
        }

        $data = $this->numberService->findById($id);

        if (empty($data)) {
            throw new HttpException(400, 'Record not found.');
        }

        return new JsonResponse($data);
    }
}
