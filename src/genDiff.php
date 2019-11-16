<?php

namespace Differ;

use function Differ\parsers\fileParse;

function genDiff($firstFilePath, $secondFilePath)
{
    $firstFile = fileParse($firstFilePath);
    $secondFile = fileParse($secondFilePath);
    $result = [];
    
    foreach ($firstFile as $key => $item) {
        if (!array_key_exists($key, $secondFile)) {
            $result['- ' . $key] = $item;
        } elseif ($firstFile[$key] === $secondFile[$key]) {
            $result['  ' . $key] = $item;
        } else {
            $result['- ' . $key] = $item;
            $result['+ ' . $key] = $secondFile[$key];
        }
    }
    
    foreach ($secondFile as $key => $item) {
        if (!array_key_exists($key, $firstFile)) {
            $result['+ ' . $key] = $item;
        }
    }
    
    $resultForPrint = "{\n";
    foreach ($result as $key => $item) {
        if (is_bool($item)) {
            $item = $item ? 'true' : 'false';
        }
        $resultForPrint .= "  $key: $item\n";
    }
    $resultForPrint .= "}";
    return $resultForPrint;
}
