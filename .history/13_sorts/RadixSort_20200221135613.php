<?php
/**
 * 基数排序
 *
 * @return void
 */

class radixSort
{
    public static function sort(&$arr)
    {
        $max = max($arr);

        for ($i = 1; $max / $i > 0; $i *= 10) {

        }
    }

    protected static function countingSort($arr, $exp)
    {
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
