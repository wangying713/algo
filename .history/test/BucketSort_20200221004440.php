<?php

/**
 * 桶排序
 */
function buckerSort(&$arr, $bucketSize = 0)
{
    $count = count($arr);
    $max = max($arr);
    $min = min($arr);
}

$numbers = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20];
$size = 10;
$rs = buckerSort($numbers); //加载了quickSort文件，请忽略前几个打印

print_r($numbers);
