<?php

/**
 * 快速排序
 *  分区，治理，递归
 */
class QuickSort
{
    public static function sort(&$nums)
    {
        $count = count($nums);
        static::sortInterally($nums, 0, $count - 1);
    }

    protected static function sortInterally(&$nums, $l, $r)
    {
        // 终止条件
        if ($l >= $r) return;
        $p = static::operation($nums, $l, $r);
        static::sortInterally($nums, $l, $p - 1);
        static::sortInterally($nums, $p + 1, $r);
    }

    protected static function operation(&$nums, $l, $r)
    {
        $pivot = $nums[$r];
        // 游标，临界点
        $p = $l;
        for ($i = $l; $i < $r; $i++) {
            if ($nums[$i] < $pivot) {
                if ($p != $i) {
                    $tmp = $nums[$i];
                    $nums[$i] = $nums[$p];
                    $nums[$p] = $tmp;
                }
                $p++;
            }
        }

        // 临界点与 r 交换位置
        $tmp = $nums[$p];
        $nums[$p] = $nums[$r];
        $nums[$r] = $tmp;

        return $p;
    }
}

$nums = [6, 7, 1, 3, 2, 5, 4];
QuickSort::sort($nums);
print_r($nums);
