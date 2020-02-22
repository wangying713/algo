<?php
/**
 * 插入排序
 *  算法：
 *      1. 将待排序数据分为已排序区间和未排序区间
 *      2. 每次从未排序区间获取一个数据，放入已排序区间的适当位置
 *      3. 重复2的步骤到未排序区间的元素未空
 *  复杂度
 *      1. 时间复杂度，根据冒泡排逆有序度的思想，交换次数是不变的。因此平均复杂度还是 O(n2)
 *          最好O(n) 已经有序。每次只需要交换一次
 *          最坏O(n2) 倒序，每次需要交换接近n 次
 *          平均 O(n2)
 *      2. 空间复杂度 O(1)、
 *      3. 是稳定排序
 *
 *
 * @param [array] $nums
 * @return void
 */
function insertionSort(array &$nums)
{
    $count = count($nums);
    // 排序边界游标
    $borderSrot = 0;
    for ($i = 1; $i < $count; $i++) {

        $tmp = $nums[$i];
        for ($j = $i - 1; $j >= 0; $j--) {
            if ($nums[$j] > $tmp) {
                // 向右偏移
                $nums[$j + 1] = $nums[$j];
            } else {
                // 比有序中最大的都比不过，何况前一个更小的？跳出
                break;
            }
        }

        // 条件满足，一定会空出来一个重复的位置为$j+1
        $nums[$j + 1] = $tmp;
    }
}
$nums = [6, 7, 1, 3, 2, 5, 4];
$rs = insertSort($nums);
print_r($nums);
