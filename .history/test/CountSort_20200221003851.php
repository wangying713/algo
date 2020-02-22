<?php

/**
 * 基数排序
 * 利用桶排序的思想，分成颗粒
 */
function countSort(&$nums)
{
    $count = count($nums);
    $max = max($nums);
    $c = [];
    for ($i = 0; $i <= $max; $i++) {
        $c[$i] = 0;
    }

    for ($i = 0; $i < $count; $i++) {
        $c[$nums[$i]]++;
    }

    for ($i = 1; $i <= $max; $i++) {
        $c[$i] = $c[$i - 1] + $c[$i];
    }

    $r = [];
    for ($i = $count - 1; $i >= 0; $i--) {
        $index = $c[$nums[$i]] - 1;
        $r[$index] = $nums[$i];
        $c[$index]--;
    }

    print_r($r);
    die;


    foreach ($r as $k => $val) {
        $nums[$k] = $val;
    }
}


$nums = [2, 5, 3, 0, 2, 3, 0, 3];
countSort($nums);
print_r($nums);
die;
