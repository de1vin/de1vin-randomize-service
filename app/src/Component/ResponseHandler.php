<?php

namespace App\Component;


use App\Component\Http\Response;

/**
 * Class ResponseReliser
 */
class ResponseRealiser
{
    /**
     * @param Response $response
     */
    public function __construct(private Response $response) {}

    public function realise(): void
    {
        http_response_code($this->response->getStatusCode());
        $this->realiseHeaders();

        echo $this->response->getContent();
    }

    private function realiseHeaders(): void
    {
        foreach ($this->response->getHeaders() as $headerKey => $headerValue) {
            header(sprintf('%s: %s', $headerKey, $headerValue));
        }
    }
}
