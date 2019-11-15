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
    $path = pathinfo($filePath);
    if ($path[extension] === 'json') {
        return jsonParser($filePath);
    } elseif ($path[extension] === 'yml') {
        return ymlParser($filePath);
    }
}