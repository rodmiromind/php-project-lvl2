<?php

namespace GenDiff\src\run;

function run($firstFilePath, $secondFilePath)
{
    var_dump(realpath($secondFilePath));
    $before = json_decode(file_get_contents("/home/piston/hexlet/project_2/php-project-lvl2/bin/before.json"), TRUE);
    $after = json_decode(file_get_contents(realpath($secondFilePath)), TRUE);
    $result = [];
    
    foreach($before as $key => $item) {
        if (!array_key_exists($key, $after)) {
            $result['- ' . $key] = $item;
        } elseif ($before[$key] === $after[$key]) {
            $result['  ' . $key] = $item;
        } else {
            $result['- ' . $key] = $item;
            $result['+ ' . $key] = $after[$key];
        }
    }
    
    foreach($a as $key => $item) {
        if (!array_key_exists($key, $b)) {
            $c['+ ' . $key] = $item; 
        }
    }
    
    var_dump($before);
    var_dump($after);
    var_dump($result);
    echo "{" . PHP_EOL;
    foreach($result as $key => $item) {
        if (is_bool($item)) {
            $item = $item ? 'true' : 'false';
        }
        echo '  ' . $key , ": " , $item . PHP_EOL;
    }
    echo "}";
}
