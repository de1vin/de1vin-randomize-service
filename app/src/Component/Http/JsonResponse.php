<?php

namespace App\Component\Http;


/**
 * Class JsonResponse
 */
class JsonResponse extends Response
{
    protected array $headers = [
        'Content-Type' => 'application/json; charset=utf-8'
    ];

    public function getContent(): string
    {
        $content = (array)$this->content;
        return json_encode($content, JSON_UNESCAPED_UNICODE);
    }
}
