<?php

namespace App\Classes;

use Illuminate\Support\Facades\Storage;

class File
{
    public static function delete($filePath, $fileName)
    {
        $filePathLastChar = substr($filePath, -1);
        $fileNameFirstChar = substr($fileName, 0, 1);

        if ($filePathLastChar == '/' && $fileNameFirstChar == '/') {
            $url = substr($filePath, 0, strlen($filePath) - 1) . $fileName;
        }

        if (
            $filePathLastChar == '/' && $fileNameFirstChar != '/'
            || $filePathLastChar != '/' && $fileNameFirstChar == '/'
        ) {
            $url = $filePath . $fileName;
        }

        if ($filePathLastChar != '/' && $fileNameFirstChar != '/') {
            $url = $filePath . '/' . $fileName;
        }

        return unlink($url);
    }
}
