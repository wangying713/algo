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

    }

}
