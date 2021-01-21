<?php

namespace Tests\Config;

use Cryptopay\AbstractResponse;
use Cryptopay\Config\Config;
use Cryptopay\Exceptions\ConfigException;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    private const CONFIG_FILE = 'cryptopay.env';


    public function testValidateConfigFailsWillThrowException()
    {
        $config = (new Config())
            ->withApiKey('test')
            ->withApiSecret('test')
            ->withBaseUrl('')
            ->withCallbackSecret('test');

        $this->expectException(ConfigException::class);
        $this->expectExceptionMessage(
            sprintf('Required configuration params not found')
        );
        $this->expectExceptionCode(AbstractResponse::HTTP_UNPROCESSABLE_ENTITY);

        $config->validateConfig();
    }

    public function testValidateConfigOkWillNotThrowException()
    {
        $config = (new Config())
            ->withApiKey('test')
            ->withApiSecret('test')
            ->withBaseUrl('test')
            ->withCallbackSecret('test');

        $config->validateConfig();
        $this->assertTrue(true);
    }
}


