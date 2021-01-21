<?php

namespace Cryptopay;

use Psr\Http\Message\ResponseInterface;

abstract class AbstractResponse implements ResponseInterface
{
    public const HTTP_CREATED = 201;
    public const HTTP_OK = 200;
    public const HTTP_NO_CONTENT = 204;
    public const HTTP_BAD_REQUEST = 400;

    public const HTTP_FORBIDDEN = 403;
    public const HTTP_NOT_FOUND = 404;
    public const HTTP_CONFLICT = 409;
    public const HTTP_UNPROCESSABLE_ENTITY = 422;

    /**
     * @param array $data
     */
    public function json(array $data)
    {
        http_response_code(self::HTTP_OK);
        die(json_encode($data));
    }
}
