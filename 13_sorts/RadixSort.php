<?php
/**
 * 基数排序
 *   比较个位，十位，百位
 *
 * @return void
 */

class RadixSort
{
    public static function sort(&$arr)
    {
        $max = max($arr);
        $maxCount = strlen($max);
        // 位数分别排序
        for ($i = 0; $i < $maxCount; $i++) {
            static::countingSort($arr, $i);
        }
    }

    protected static function countingSort(&$arr, $loop)
    {
        $count = count($arr);
        // 位数，0-个位，1-十位，2-100位
        $divisor = pow(10, $loop);

        $buckets = [];
        for ($i = 0; $i < $count; $i++) {
            // 对应位数取余，放到指定的桶中
            $index = ($arr[$i] / $divisor) % 10;
            $buckets[$index][] = $arr[$i];
        }

        // 将对应的数据，放入对应的位置
        $k = 0;
        for ($i = 0; $i < 10; $i++) {
            if (!isset($buckets[$i])) {
                continue;
            }

            foreach ($buckets[$i] as $val) {
                $arr[$k++] = $val;
            }
        }
    }
}

$nums = [1, 99, 100, 8888, 9999, 947, 1, 2, 3, 4, 5, 6];
RadixSort::sort($nums);
print_r($nums);
