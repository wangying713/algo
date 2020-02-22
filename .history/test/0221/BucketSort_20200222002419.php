<?php

/**
 * 桶排序
 */
function buckerSort(&$arr, $bucketSize = 0)
{

    $count = count($arr);
    if ($bucketSize == 0) {
        $bucketSize = (int) $count / 2;
    }

    // 用来计算桶的个数。区间跨度 ($val-$min)%$bucketSize;
    $min = min($arr);

}

$numbers = [15, 16, 17, 18, 19, 7, 8, 9, 10, 11, 1, 2, 3, 4, 5, 6, 12, 13, 14, 20];
$size = 10;
$rs = buckerSort($numbers); //加载了quickSort文件，请忽略前几个打印

print_r($numbers);
