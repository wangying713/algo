<?php

/**
 * 桶排序
 */
function buckerSort(&$arr, $bucketSize = 0)
{
    $count = count($arr);
    if ($bucketSize == 0) {
        $bucketSize = $count;
    }

    // 用来计算桶的个数。区间跨度 ($val-$min)/$bucketSize;
    $min = min($arr);
    $buckets = [];
    for ($i = 0; $i < $count; $i++) {
        $index = (int) (($arr[$i] - $min) / $bucketSize);
        $buckets[$index][] = $arr[$i];
    }

    $bucketCount = count($buckets);
    $k = 0;
    for ($i = 0; $i < $bucketCount; $i++) {

        if (!isset($buckets[$i])) {
            continue;
        }

        sort($buckets[$i]);
        foreach ($bucketCount[$i] as $val) {
            $arr[$k++] = $val;
        }
    }
}

$numbers = [15, 16, 17, 18, 19, 7, 8, 9, 10, 11, 1, 2, 3, 4, 5, 6, 12, 13, 14, 20];
$size = 10;
$rs = buckerSort($numbers); //加载了quickSort文件，请忽略前几个打印

print_r($numbers);
