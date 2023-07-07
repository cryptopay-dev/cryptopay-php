<?php

namespace Tests\Utils;

use Cryptopay\AbstractResponse;
use Cryptopay\Exceptions\DirectoryException;
use Cryptopay\Utils\DirectoryUtils;
use PHPUnit\Framework\TestCase;

class DirectoryUtilsTest extends TestCase
{
    public function testSearchParentFolderWillStopAfterStepsAndThrowException()
    {
        $currentDirectory = '/dir1/dir2/dir3/dir4/dir5/dir6/dir7';
        $search = 'vendor';

        $this->expectException(DirectoryException::class);
        $this->expectExceptionCode(AbstractResponse::HTTP_UNPROCESSABLE_ENTITY);
        $this->expectExceptionMessage(sprintf('Directory %s was not found in provided path', $search));

        DirectoryUtils::searchParentFolder($currentDirectory, $search);
    }

    public function testSearchParentFolderCantFindFolderWillThrowException()
    {
        $currentDirectory = __DIR__;
        $search = 'vendors';

        $this->expectException(DirectoryException::class);
        $this->expectExceptionCode(AbstractResponse::HTTP_UNPROCESSABLE_ENTITY);
        $this->expectExceptionMessage(sprintf('Directory %s was not found in provided path', $search));

        DirectoryUtils::searchParentFolder($currentDirectory, $search);
    }

    public function testSearchParentFolderWillReturnDirectoryPathIfDirectoryExists()
    {
        $currentDirectory = __DIR__;
        $search = 'vendor';
        $parentDirectory = dirname($currentDirectory);

        $fullPath = $parentDirectory . '/' . $search;
        if (!file_exists($parentDirectory . $search)) {
            mkdir($fullPath, 777);
        }

        $path = DirectoryUtils::searchParentFolder($currentDirectory, $search);
        $this->assertEquals($path, $parentDirectory);

        if (file_exists($fullPath)) {
            rmdir($fullPath);
        }
    }
}
