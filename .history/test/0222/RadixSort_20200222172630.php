<?php
/**
 * 基数排序（位排序）
 *  算法步骤
 *      1. 借助桶排序的思想，分成多个桶。
 *      2. 先比较个位，十位，百位，千位
 *      3. 不足位数的，补0
 *
 *  基数排序对要排序的数据是有要求的，需要可以分割出独立的“位”来比较，而且位之间有递进的关系
 *  如果 a 数据的高位比 b 数据大，那剩下的低位就不用比较了。
 *  除此之外，每一位的数据范围不能太大，要可以用线性排序算法来排序，否则，基数排序的时间复杂度就无法做到 O(n) 了。
 */
class RadixSort
{

    public static function sort(array &$nums)
    {
        $max = max($nums);
        // 最长的长度
        $maxCount = strlen($max);

        for ($i = 0; $i < $maxCount; $i++) {
            static::_radixSort($nums, $i);
        }
    }

    protected static function _radixSort(array &$nums, $loop)
    {
        $count = count($nums);

        $div = pow(10, $loop);
        $buckets = [];
        for ($i = 0; $i < $count; $i++) {
            // 计算应该放在哪个桶中
            $index = ($nums[$i] / $div) % 10;
            $buckets[$index][] = $nums[$i];
        }

        print_r($buckets);

        // 将桶内数据拷贝到 nums 中
        $bucketCount = count($buckets);
        $k = 0;
        for ($i = 0; $i < $bucketCount; $i++) {
            if (!isset($bucketCount[$i])) {
                continue;
            }

            foreach ($buckets[$i] as $val) {
                $nums[$k++] = $val;
            }
        }
    }
}
$nums = [1, 99, 100, 8888, 9999, 947, 1, 2, 3, 4, 5, 6];
RadixSort::sort($nums);
print_r($nums);
