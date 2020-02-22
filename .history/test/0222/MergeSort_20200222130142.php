<?php
/**
 * 归并排序
 *  算法步骤：
 *      1. 采用递归+分治的思想，将数组元素拆分（中间拆分）
 *      2. 重复1的操作，一直到不能继续拆分
 *      3. 排序归并
 *          1. 两侧比较，取出最小的放到tmp 中。
 *
 *  复杂度
 *      时间复杂度
 *          归并排序的最好，最坏，平均都是 O(nlogn)
 *          假设拆分需要消耗的时间总和是 t(n) 合并的时间复杂度为 n，那么第一层需要消耗的时间为 t(n) + n
 *          一共有 logn 层，那么总的复杂度就是 nlogn + nlogn 去除低阶，最终的平均复杂度为 O(nlogn)
 *      归并排序是原地算法，需要处理好 merge
 *
 *      空间复杂度 O(1)
 */

class MergeSort
{

    /**
     * 归并排序
     *
     * @param array $nums
     * @return void
     */
    public static function sort(array &$nums)
    {
        $count = count($nums);
        static::sortInterally($nums, 0, $count - 1);
    }

    /**
     * 递归分治
     *
     * @param array $nums
     * @param [int] $l
     * @param [int] $r
     * @return void
     */
    public static function sortInterally(array &$nums, $l, $r)
    {

        // 终止条件
        if ($l >= $r) {
            return;
        }

        // 获取中间值，防止数据太大溢出
        $m = $l + (int) (($r - $l) / 2);

        // 递归分治
        static::sortInterally($nums, $l, $m);
        static::sortInterally($nums, $m + 1, $r);

        // 两侧数组合并
        static::merge($nums, $l, $m, $r);
    }

    /**
     * 合并
     *
     * @param array $nums
     * @param [int] $l
     * @param [int] $m
     * @param [int] $r
     * @return void
     */
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

        // 将剩余数据push 到变量中
        while ($i <= $m) {
            $tmp[] = $nums[$i];
            $i++;
        }

        // 将排序好的数据 copy 到 nums 中
        foreach ($tmp as $key => $val) {
            // 这个 key 一定是要从 l 开始
            $nums[$l + $key] = $val;
        }
    }

}

$nums = [6, 7, 1, 3, 2, 5, 4];
MergeSort::sort($nums);
print_r($nums);
