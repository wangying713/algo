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

    public static function sortInterally(array &$nums, $l, $r)
    {
        // 终止条件
        if ($l >= $r) {
            return;
        }

        $p = static::partition($nums, $l, $r);

        var_dump($p);
        var_dump($r);
        sleep(1);
        static::sortInterally($nums, $l, $p - 1);
        static::sortInterally($nums, $p + 1, $r);
    }

    public static function partition(array &$nums, $l, $r)
    {
        $povit = $nums[$r];
        $border = $l;
        for ($i = $l; $i < $r; $i++) {
            if ($nums[$i] < $povit) {

                // 当前值与临界点相等的证明是同一个值，没必要交换
                if ($border != $i) {
                    $tmp = $nums[$border];
                    $nums[$border] = $nums[$i];
                    $nums[$i] = $tmp;
                }

                $border++;
            }
        }

        // 中间值与临界点交换
        $tmp = $nums[$r];
        $nums[$r] = $nums[$border];
        $nums[$border] = $tmp;

        return $border;

    }

}
$nums = [6, 11, 3, 9, 8];
QuickSort::sort($nums);

print_r($nums);
