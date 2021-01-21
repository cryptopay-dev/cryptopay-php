<?php

namespace Tests;

use Cryptopay\AbstractResponse;
use Cryptopay\Exceptions\CallbackException;
use Cryptopay\Exceptions\ForbiddenException;
use Cryptopay\Service\CallbackService;

class CallbackServiceTest extends BaseTest
{
    public function testCallbackWrongJsonFormatReturnCallbackException()
    {
        $wrongFormatJsonCode = 4;
        $callbackService = new CallbackService('callbackSecret');
        $callbackDataJson = file_get_contents(
            dirname(__DIR__) . '/data/callback/callback_wrong_format.json'
        );

        $this->expectException(CallbackException::class);
        $this->expectExceptionCode(AbstractResponse::HTTP_UNPROCESSABLE_ENTITY);

        $message = sprintf("Invalid JSON. Code: %s. Data: %s", $wrongFormatJsonCode, $callbackDataJson);
        $this->expectExceptionMessage($message);
        $callbackService->validateCallback($callbackDataJson, []);
    }

    public function testCallbackWrongJsonFormatReturnCallbackExcpetion()
    {
        $callbackService = new CallbackService('callbackSecret');
        $callbackDataJson = file_get_contents(dirname(__DIR__) . '/data/callback/callback.json');

        $this->expectException(ForbiddenException::class);
        $this->expectExceptionCode(AbstractResponse::HTTP_FORBIDDEN);
        $this->expectExceptionMessage('Forbidden');
        $callbackService->validateCallback($callbackDataJson, []);
    }

    public function testCallbackCheckErrorThrowForbidden()
    {
        $callbackService = new CallbackService('callbackSecret');
        $callbackDataJson = file_get_contents(dirname(__DIR__) . '/data/callback/callback.json');

        $this->expectException(ForbiddenException::class);
        $this->expectExceptionCode(AbstractResponse::HTTP_FORBIDDEN);
        $this->expectExceptionMessage('Forbidden');
        $callbackService->validateCallback($callbackDataJson, ['x-cryptopay-signature' => 'wrong-signature']);
    }

    public function testCallbackSignatureValidShouldReturnCallbackBody()
    {
        $callbackService = new CallbackService('callbackSecret');
        $callbackDataJson = file_get_contents(dirname(__DIR__) . '/data/callback/callback.json');
        $signature = $this->buildSignature($callbackDataJson);
        $response = $callbackService->validateCallback($callbackDataJson, ['x-cryptopay-signature' => $signature]);
        $this->assertEquals($callbackDataJson, $response);
    }

    /**
     * @param string $callbackBodyJson
     * @return string
     */
    private function buildSignature(string $callbackBodyJson)
    {
        return hash_hmac(
            'sha256',
            $callbackBodyJson,
            'callbackSecret'
        );
    }
}
