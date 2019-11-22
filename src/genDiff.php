<?php

namespace Differ;

use function Differ\parsers\fileParse;
use Funct;

// переписать эти 2 функции в одну

// function diffFrom1to2($before, $after)
// {
//     foreach($before as $key => $value) {
//         if (!is_array($value) && array_key_exists($key, $after)) {
//           if ($value !== $after[$key]) {
//             $result[$key] = [[$value, 'removed'], [$after[$key], 'added']];
//           } else {
//             $result[$key] = [$value, 'not changed'];
//           }
//         } elseif (array_key_exists($key, $after)) {
//           $result[$key] = array_diff_assoc_recursive($value, $after[$key]);
//         } else {
//           $result[$key] = [$value, 'removed'];
//         }
//       }
    
//     return $result;
// }

// function diffFrom2to1($after, $before)
// {
//     foreach($after as $key => $value) {
//         if (!array_key_exists($key, $before)) {
//           $result[$key] = [$value, 'added'];
//         } elseif (is_array($value) && array_key_exists($key, $before)) {
//           $new_diff = array_diff_assoc_recursive2($value, $before[$key]);
//           if($new_diff != FALSE) {
//             $result[$key] = $new_diff;
//           }
          
//         }
//       }
      
//     return $result;
// }

function diff($firstFile, $secondFile)
{
  // var_dump($firstFile, $secondFile);

  function array_keys_recursive($firstFile) {
    foreach($firstFile as $key => $value) {
        $result[] = $key;
        if(is_array($value)){
            $result = array_merge($result, array_keys_recursive($value));
        }
    }
    return $result;
  }
  $keys = Funct\Collection\union(array_keys_recursive($firstFile), array_keys_recursive($secondFile));
  var_dump($keys);
}


function genDiff($firstFilePath, $secondFilePath)
{
    $firstFile = fileParse($firstFilePath);
    $secondFile = fileParse($secondFilePath);
    
    // $resultDiff1to2 = diffFrom1to2($firstFile, $secondFile);
    // $resultDiff2to1 = diffFrom2to1($secondFile, $firstFile);
    
    
    // $diffData = array_merge_recursive($resultDiff1to2, $resultDiff2to1);
    $a = diff($firstFile, $secondFile);
    // var_dump($a);
}
