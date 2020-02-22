<?php
/**
 * 基数排序
 *
 * @return void
 */

class RadixSort
{
    public static function sort(&$arr)
    {
        $max = max($arr);
        $maxCount = count($max);
        for ($i = 0; $i < $maxCount; $i++) {
            static::countingSort($arr, $i);
        }
    }

    protected static function countingSort($arr, $loop)
    {
        $count = count($arr);
        $divisor = pow(10, $loop);

        $buckets = [];
        for ($i = 0; $i < $count; $i++) {
            // 对应位数取余，放到指定的桶中
            $index = ($arr[$i] / $divisor) % 10;
            $buckets[$index] = $arr[$i];
        }

        print_r($buckets);

        return;
        if (count($arr) <= 1) {
            return;
        }

        $c = [];
        for ($i = 0; $i < count($arr); $i++) {
            $c[$arr[$i] / $exp % 10]++;
        }
        print_r($c);
    }
}

$nums = [1, 99, 100, 8888, 9999];
$rs = RadixSort::sort($nums);
