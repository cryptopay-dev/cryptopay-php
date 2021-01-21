<?php

namespace Cryptopay\Utils;

use Cryptopay\AbstractResponse;
use Cryptopay\Exceptions\DirectoryException;

class DirectoryUtils
{
    private const STEPS = 5;

    /**
     * @param string $path
     * @param string $folderName
     * @return string
     * @throws DirectoryException
     */
    public static function searchParentFolder(string $path, string $folderName): string
    {
        $steps = self::STEPS;
        while ($steps && $path !== '/') {
            $steps--;
            $path = dirname($path);
            $folder = $path . '/' . $folderName;
            if (file_exists($folder) && is_dir($folder)) {
                return $path;
            }
        }
        throw new DirectoryException(
            sprintf('Directory %s was not found in provided path', $folderName),
            AbstractResponse::HTTP_UNPROCESSABLE_ENTITY
        );
    }
}
