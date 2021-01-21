<?php

namespace Tests\Config;

use Cryptopay\AbstractResponse;
use Cryptopay\Config\ConfigEnv;
use Cryptopay\Exceptions\ConfigException;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;

class ConfigEnvTest extends TestCase
{
    private const VENDOR_DIRECTORY = 'vendors';
    private const CONFIG_FILE_NAME = 'crypto.env';

    public function testInitWithEmptyParametersWillThrowException()
    {
        $configEnv = new ConfigEnv();
        $configFilename = $configEnv->getConfigFileName();
        $configFile = dirname(__DIR__, 2) . '/config/' . $configFilename;
        $this->createConfigFile($configFile);

        try {
            $configEnv->init();
        } catch (ConfigException $e) {
            $this->assertEquals(AbstractResponse::HTTP_UNPROCESSABLE_ENTITY, $e->getCode());
            $this->assertEquals('Required configuration params not found', $e->getMessage());
        }

        $this->deleteConfigFolder($configFile);
    }

    public function testInitWithParametersOk()
    {
        $configEnv = new ConfigEnv();
        $configFile = $path = dirname(__DIR__, 2) . '/config/' . $configEnv->getConfigFileName();
        $testDataFile = $path = dirname(__DIR__,) . '/data/config/' . $configEnv->getConfigFileName();
        $this->createConfigFile($configFile);
        copy($testDataFile, $configFile);

        $configEnv->init();
        $this->assertTrue(true);

        $this->deleteConfigFolder($configFile);
    }

    public function testGetConfigPathDirectoryNotFoundThrowException()
    {
        $method = $this->setAccesibility(ConfigEnv::class, 'getConfigPath');

        $this->expectException(ConfigException::class);
        $this->expectExceptionCode(AbstractResponse::HTTP_UNPROCESSABLE_ENTITY);
        $this->expectExceptionMessage(
            sprintf('Directory %s was not found in provided path', self::VENDOR_DIRECTORY)
        );

        $configEnv = new ConfigEnv();
        $configEnv->setVendorDirectory(self::VENDOR_DIRECTORY);
        $method->invokeArgs($configEnv, []);
    }

    public function testGetConfigPathConfigFileNotFoundWillThrowException()
    {
        $method = $this->setAccesibility(ConfigEnv::class, 'getConfigPath');

        $this->expectException(ConfigException::class);
        $this->expectExceptionCode(AbstractResponse::HTTP_UNPROCESSABLE_ENTITY);
        $this->expectExceptionMessage(sprintf('Please create %s in config folder', self::CONFIG_FILE_NAME));

        $configEnv = new ConfigEnv();
        $configEnv->setConfigFileName(self::CONFIG_FILE_NAME);
        $method->invokeArgs($configEnv, []);
    }

    public function testGetConfigPathFoundAndReturnCorrectPath()
    {

        $method = $this->setAccesibility(ConfigEnv::class, 'getConfigPath');

        $configEnv = new ConfigEnv();
        $configFile = $path = dirname(__DIR__, 2) . '/config/' . $configEnv->getConfigFileName();
        $this->createConfigFile($configFile);

        $result = $method->invokeArgs($configEnv, []);

        $path = dirname(__DIR__, 2) . '/config/';
        $this->assertEquals($path, $result);

        $this->deleteConfigFolder($configFile);
    }

    /**
     * @param string $class
     * @param string $method
     * @return ReflectionMethod|string
     * @throws ReflectionException
     */
    private function setAccesibility(string $class, string $method)
    {
        $reflectionClass = new ReflectionClass($class);
        $method = $reflectionClass->getMethod($method);
        $method->setAccessible(true);
        return $method;
    }

    /**
     * @param string $configFilePath
     */
    private function deleteConfigFolder(string $configFilePath)
    {
        if (file_exists($configFilePath)) {
            unlink($configFilePath);
        }
        $directoryPath = dirname($configFilePath);
        if (file_exists($directoryPath)) {
            rmdir($directoryPath);
        }
    }

    /**
     * @param string $configFilePath
     */
    private function createConfigFile(string $configFilePath)
    {
        $directoryPath = dirname($configFilePath);
        if (!file_exists($directoryPath)) {
            mkdir($directoryPath, 0777);
        }
        file_put_contents($configFilePath, '');
    }
}


