<?php

namespace Differ\parsers;

use Symfony\Component\Yaml\Yaml;

function jsonParser($filePath)
{
    $fileParsed = json_decode(file_get_contents(realpath($filePath)), true);
    return $fileParsed;
}

function ymlParser($filePath)
{
    $fileParsed = Yaml::parseFile(realpath($filePath));
    return $fileParsed;
}

function fileParse($filePath)
{
    $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
    if ($fileExtension === 'json') {
        return jsonParser($filePath);
    } elseif ($fileExtension === 'yml') {
        return ymlParser($filePath);
    }
}