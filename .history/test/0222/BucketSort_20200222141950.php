<?php
/**
 * 桶排序
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
        $index = ($nums[$i] = $min) / $size;
        $buckets[] = $nums[$i];
    }

    $bucketCount = count($buckets);
    for ($i = 0; $i < $bucketCount; $i++) {

        // 将桶内的数据取出，利用快速排序

        foreach ($buckets[$i] as $val) {

        }
    }
}
