<?php

namespace GenDiff\src\run;

function run($firstFilePath, $secondFilePath)
{
    $firstFile = json_decode(file_get_contents(realpath($firstFilePath)), true);
    $secondFile = json_decode(file_get_contents(realpath($secondFilePath)), true);
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
    
    foreach ($a as $key => $item) {
        if (!array_key_exists($key, $b)) {
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
    echo $resultForPrint;
    return $resultForPrint;
}
