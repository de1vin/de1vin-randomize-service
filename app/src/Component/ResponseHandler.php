<?php

namespace App\Component;


use App\Component\Http\Response;

/**
 * Class ResponseReliser
 */
readonly class ResponseHandler
{
    /**
     * @param Response $response
     */
    public function __construct(private Response $response) {}

    public function handle(): void
    {
        http_response_code($this->response->getStatusCode());
        $this->sendHeaders();

        echo $this->response->getContent();
    }

    private function sendHeaders(): void
    {
        foreach ($this->response->getHeaders() as $headerKey => $headerValue) {
            header(sprintf('%s: %s', $headerKey, $headerValue));
        }
    }
}
