<?php

namespace App\Controller;

use App\Component\Http\JsonResponse;


/**
 * Class MainController
 */
class MainController
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return new JsonResponse('OK');
    }
}
