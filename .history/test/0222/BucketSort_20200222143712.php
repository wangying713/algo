<?php
/**
 * 桶排序
 *  算法步骤
 *      1. 如何将 n 个数据分配到 m 个桶内。
 *          1. 计算区间跨度 nums[i] - min / size
 *          2. 在处理数据时候，我们可以指定该数据放入哪个桶内，利用1的计算方式
 *      2. 每个桶使用快速排序，最终合并到原始数据中
 *
 *  复杂度
 *      空间复杂度 O(n)
 *      时间复杂度
 *          最好最坏还需要看数据规模，区间跨度，与桶分配的合理性，如果桶的数据接近 n，那么时间复杂度将退化到 O(nlogn)
 *          平均：
 *              假设每个桶内的数据都是平均的，那么每个桶内的数据是 k=n/m ，对每个桶进行快速排序 将会是 O(klogk)，
 *              m 个桶则为 O(mklogk)，因为 k=n/m 则为 O(nlogn/m)，当 m 接近为 n，复杂度就会是 logn，因此平均复杂度为0(n)

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
