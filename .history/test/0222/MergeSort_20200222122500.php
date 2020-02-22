<?php
/**
 * 归并排序
 *  算法步骤：
 *      1. 采用递归+分治的思想，将数组元素拆分（中间拆分）
 *      2. 重复1的操作，一直到不能继续拆分
 *      3. 排序归并
 *          1. 两侧比较，取出最小的放到tmp 中。
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
        if ($l >= $r) {
            return;
        }

        $m = $l + (int) (($r - $l) / 2);
        static::sortInterally($nums, $l, $m);
        static::sortInterally($nums, $m + 1, $r);
        static::merge($nums, $l, $m, $r);
    }

    protected function merge(array &$nums, $l, $m, $r)
    {

        // 取出左侧数据，与右侧数据进行对比
        $i = $l;
        $j = $m + 1;
        $tmp = [];
        while ($i <= $m && $j <= $r) {
            if ($nums[$i] < $nums[$j]) {
                $tmp[] = $nums[$i];
                // 左侧偏移
                $i++;
            } else {
                $tmp[] = $nums[$j];
                $j++;
            }
        }

        // 如果右侧有数据没处理完，那么左侧一定已经处理完了
        if ($j <= $r) {
            $i = $j;
            $m = $r;
        }

        while($i<=$m) {
            $tmp[] $nums[$i];
        }
    }

}

$nums = [6, 7, 1, 3, 2, 5, 4];
MergeSort::sort($nums);
print_r($nums);
