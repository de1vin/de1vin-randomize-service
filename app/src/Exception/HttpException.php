<?php

namespace App\Exception;

use HttpException;
use Throwable;

/**
 * Class HttpException
 */
class AppHttpException extends HttpException
{


    protected int $errorCode;

    /**
     * @param int    $errorCode
     * @param string $message
     * @param int    $code
     *
     * @param Throwable|null $previous
     */
    public function __construct(int $errorCode, string $message = '', int $code = 0, ?Throwable $previous = null)
    {
        $this->errorCode = $errorCode;

        parent::__construct($message, $code, $previous);
    }

    /**
     * @return int
     */
    public function getErrorCode(): int
    {
        return $this->errorCode;
    }
}
