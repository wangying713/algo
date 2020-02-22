<?php
/**
 * 桶排序
 *  将数据分配到 m 个桶内，每个桶使用快速排序
 */
function bucketSort(&$nums, $size = 0)
{
    $count = count($nums);
    if ($size == 0) {
        $size = $count;
    }

    $min = min($nums);
}
