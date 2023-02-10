<?php

namespace App\Service;


use App\Exception\HttpException;
use App\Helper\Uuid;
use App\Repository\NumberRepository;

/**
 * Class NumberService
 */
readonly class NumberService
{
    public function __construct(private NumberRepository $numberRepository)
    {}

    /**
     * @param string $id
     *
     * @return array
     *
     * @throws
     */
    public function findById(string $id): array
    {
        if (!Uuid::isValid($id)) {
            throw new HttpException(400, 'Parameter "id" is not valid UUID format');
        }
//        var_dump($this->numberRepository->getById($id));die;

        return $this->numberRepository->getById($id);
    }

    /**
     * @return array
     */
    public function createRandom(): array
    {
        do {
            $randomNumber = mt_rand(1000000, 9999999);
        } while ($this->numberRepository->numberIsExist($randomNumber));

        return $this->numberRepository->saveNumber($randomNumber);
    }
}
