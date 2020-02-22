<?php
/**
 * 基数排序
 *  排个位，十位，百位
 */
class RadixSort
{

    public static function sort(&$nums)
    {
        $max = max($nums);
        $maxCount = strlen($max);
        for ($i = 0; $i < $maxCount; $i++) {
            static::_radixSort($nums, $i);
        }
    }

    protected static function _radixSort(&$nums, $loop)
    {
        $count = count($nums);
        $divisor = pow(10, $loop);
        $buckets = [];
        for ($i = 0; $i < $count; $i++) {
            $index = ($nums[$i] / $divisor) % 10;
            $buckets[$index][] = $nums[$i];
        }
        // 位排序
        $k = 0;
        for ($i = 0; $i < 10; $i++) {
            if (!isset($buckets[$i])) {
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
