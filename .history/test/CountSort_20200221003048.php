<?php

/**
 * 基数排序
 * 利用桶排序的思想，分成颗粒
 */
function countSort(&$nums)
{
    $count = count($nums);
    $max = max($count);

    $c = [];
    for($i=0; $i<=$max; $i++) {
        $c[$i] = 0;
    }

    for($i=0; $i<$count; $i++) {
        
    }
}


$nums = [2, 5, 3, 0, 2, 3, 0, 3];
countSort($nums);
var_dump($nums);
die;
