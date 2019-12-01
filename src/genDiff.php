<?php

namespace Differ;

use function Differ\parsers\fileParse;
use Funct;

function array_keys_recursive($firstFile) {
  foreach($firstFile as $key => $value) {
      $result[] = $key;
      if(is_array($value)){
          $result = array_merge($result, array_keys_recursive($value));
      }
  }
  return $result;
}

function makeNode($key, $value, $action, $children = null)
{
  return [
    "key" => $key,
    "value" => $value,
    "action" => $action,
    "children" => $children
    ];
}

function diff($firstFile, $secondFile)
{
  // var_dump($firstFile, $secondFile);
  $keys = Funct\Collection\union(array_keys_recursive($firstFile), array_keys_recursive($secondFile));
  
  $result = array_reduce($keys, function ($acc, $key) use ($firstFile, $secondFile) {
    if (array_key_exists($key, $firstFile) && (array_key_exists($key, $secondFile)) && is_array($firstFile[$key])) {
            $acc[] = makeNode($key, null, "nested", diff($firstFile[$key], $secondFile[$key]));
      return $acc;
    } elseif (array_key_exists($key, $firstFile) && !array_key_exists($key, $secondFile)) {
      $acc[] = makeNode($key, $firstFile[$key], "removed");
    } elseif (!array_key_exists($key, $firstFile) && array_key_exists($key, $secondFile)) {
      $acc[] = makeNode($key, $secondFile[$key], "added");
    } elseif (array_key_exists($key, $firstFile) && array_key_exists($key, $secondFile)) {
        if ($firstFile[$key] === $secondFile[$key]) {
          $acc[] = makeNode($key, $firstFile[$key], "not changed");
        } else {
          $acc[] = makeNode($key, $firstFile[$key], "removed");
          $acc[] = makeNode($key, $secondFile[$key], "added");
        }
    }
    return $acc;

}, []);

return $result;
}


function genDiff($firstFilePath, $secondFilePath)
{
    $firstFile = fileParse($firstFilePath);
    $secondFile = fileParse($secondFilePath);
    
    // $resultDiff1to2 = diffFrom1to2($firstFile, $secondFile);
    // $resultDiff2to1 = diffFrom2to1($secondFile, $firstFile);
    
    
    // $diffData = array_merge_recursive($resultDiff1to2, $resultDiff2to1);
    $a = diff($firstFile, $secondFile);
    print_r($a);
}
