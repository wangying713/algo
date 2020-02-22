<?php
/**
 * 归并排序
 *  算法步骤：
 *      1. 采用递归+分治的思想，将数组元素拆分（中间拆分）
 *      2. 重复1的操作，一直到不能继续拆分
 *      3. 排序归并
 */
class MergeSort
{
    public static function sort(array &$nums)
    {
        $count = count($nums);
        static::sortInterally($nums, 0, $count - 1);
    }

    public static function sortInterally(array &$nums, $l, $r)
    {
        $m = $l+int(($r-$l)/2)
    }

}

$nums = [6, 7, 1, 3, 2, 5, 4];
MergeSort::sort($nums);
print_r($nums);
