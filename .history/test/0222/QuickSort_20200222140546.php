<?php
/**
 * 快速排序
 *  算法步骤：
 *      1. 快速排序与归并排序的思想有相似的地方
 *      2. 取一个临界点 pivot与数组中的元素进行比较，小的放 pivot 的左边，大的放右边，pivot 放中间
 *      3. 分治，左侧/右侧的数据再次分治
 *      4. 重复2，3的操作，一直到不能继续分治
 *  复杂度
 *      空间复杂度 O(1)
 *      稳定性：在排序过程中，临界点会与中间值交换，因此不是稳定排序
 *      时间复杂度：
 *          1. 最好：当倒序的时候，为O(n)
 *          2. 最差：当原始数据有序的时候，退化为(n)
 *          3. 平均：
 *              与归并排序的方法类似，因此也是O(nlogn)
 *  优化
 *      快速排序的性能主要要看 povit 的处理
 *      1. 三数取中法，首尾中间，取值是中间的值作为 povit
 *      2. 随机数
 */

class QuickSort
{
    /**
     * 快速排序
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

        $border = static::partition($nums, $l, $r);

        static::sortInterally($nums, $l, $border - 1);
        static::sortInterally($nums, $border + 1, $r);
    }

    /**
     * 排序治理
     *
     * @param array $nums
     * @param [int] $l
     * @param [int] $r
     * @return void
     */
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

        // 将 povit 放到中间，border 放到最后
        $tmp = $nums[$r];
        $nums[$r] = $nums[$border];
        $nums[$border] = $tmp;

        return $border;
    }
}

$nums = [6, 11, 3, 9, 8];
QuickSort::sort($nums);

print_r($nums);
