<?php

namespace Tests;

use VCR\VCR;

abstract class ApiTest extends BaseTest
{
    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        if ($this->isVCRSupported()) {
            VCR::configure()
                ->setCassettePath('tests/cassettes')
                ->enableLibraryHooks(['curl'])
                ->enableRequestMatchers(['method', 'url', 'query_string'])
                ->setMode('once');
            VCR::turnOn();
        }

        parent::__construct($name, $data, $dataName);
    }

    protected function setUp(): void
    {
        if (!$this->isVCRSupported()) {
            $this->markTestSkipped('VCR tests are not supported for this PHP version');
        }
    }

    // https://github.com/php-vcr/php-vcr/issues/373
    private function isVCRSupported(): bool
    {
        return version_compare(PHP_VERSION, '8.2.0', '<');
    }
}
