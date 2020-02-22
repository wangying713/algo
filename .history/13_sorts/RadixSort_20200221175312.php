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
        $maxCount = strlen($max);
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
            $buckets[$index][] = $arr[$i];
        }

        $k = 0;
        for ($i = 0; $i < 10; $i++) {
            if (!isset($buckets[$i])) {
                continue;
            }

            foreach ($buckets[$i] as $val) {
                $arr[$k++] = $val;
            }
        }

        print_r($arr);

    }
}

$nums = [1, 99, 100, 8888, 9999, 948];
$rs = RadixSort::sort($nums);

print_r($nums);
