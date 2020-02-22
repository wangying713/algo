<?php
/**
 * 快速排序
 *  算法步骤：
 *      1. 快速排序与归并排序的思想有相似的地方
 *      2. 取一个临界点 pivot与数组中的元素进行比较，小的放 pivot 的左边，大的放右边，pivot 放中间
 *      3. 分治，左侧/右侧的数据再次分治
 *      4. 重复2，3的操作，一直到不能继续分治
 *  复杂度
 */

class QuickSort
{
    public static function sort(array &$nums)
    {
        $count = count($nums);
        static::sortInterally($nums, 0, $count - 1);
    }

    public static function sortInteally(&$nums, $l, $r)
    {
        $povit
    }

}
