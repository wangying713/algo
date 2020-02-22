<?php
/**
 * 桶排序
 *  算法步骤
 *      1. 如何将 n 个数据分配到 m 个桶内。
 *          1. 计算区间跨度 nums[i] - min / size
 *          在处理数据时候，我们可以指定该数据放入哪个桶内。
 *  将数据分配到 m 个桶内，每个桶使用快速排序
 *  // 最前面的桶的数据一定是最小的

 */
function bucketSort(&$nums, $size = 0)
{
    $count = count($nums);
    if ($size == 0) {
        $size = $count;
    }

    // 最小值，用来计算区间跨度
    $min = min($nums);
    $buckets = [];
    for ($i = 0; $i < $count; $i++) {
        // 指定放入哪个桶内
        $index = ($nums[$i] - $min) / $size;
        $buckets[$index][] = $nums[$i];
    }

    $bucketCount = count($buckets);
    $k = 0;
    for ($i = 0; $i < $bucketCount; $i++) {
        // 对每个桶内的数据进行排序
        sort($buckets[$i]);
        foreach ($buckets[$i] as $val) {
            $nums[$k++] = $val;
        }
    }
}

$numbers = [15, 16, 17, 18, 19, 7, 8, 9, 10, 11, 1, 2, 3, 4, 5, 6, 12, 13, 14, 20];
$size = 10;
$rs = bucketSort($numbers); //加载了quickSort文件，请忽略前几个打印

print_r($numbers);
