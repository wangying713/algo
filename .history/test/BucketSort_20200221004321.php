<?php

/**
 * 桶排序
 */
function buckerSort(&$arr, $bucketSize = 0)
{
    $count = count($arr);
    if ($count < 2) return;

    // 桶的大小
    if ($bucketSize == 0) $bucketSize = $count;

    $min = min($arr);
    $max = max($arr);

    $buckets =  [];
    // 将数组分配到各个桶中
    for ($i = 0; $i < $count; $i++) {
        $index = ceil(($arr[$i] - $min) / $bucketSize);
        $buckets[$index][] = $arr[$i];
    }

    $k = 0;
    // 桶的数量
    $bucketCount = count($buckets);
    for ($i = 0; $i < $bucketCount; $i++) {
        // 对每个桶进行排序，这里使用了快速排序
        sort($buckets[$i]);
        foreach ($buckets[$i] as $val) {
            $arr[$k++] = $val;
        }
    }
}

$numbers = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20];
$size = 10;
$rs = buckerSort($numbers); //加载了quickSort文件，请忽略前几个打印

print_r($numbers);
