<?php
/**
 * 插入排序
 *  算法：
 *      1. 将待排序数据分为已排序区间和未排序区间
 *      2. 每次从未排序区间获取一个数据，放入已排序区间的适当位置
 *      3. 重复2的步骤到未排序区间的元素未空
 *  复杂度
 *      1. 时间复杂度
 *          最好O(n) 已经有序
 *          最坏O(n2) 倒序
 *          平均 O(n2)
 *      2. 空间复杂度 O(1)、
 *      3. 是稳定排序
 *
 *
 * @param [type] $nums
 * @return void
 */
function insertSort(&$nums)
{
    $count = count($nums);

    $p = 0;
    for ($i = 0; $i < $count; $i++) {

        for ($j = 0; $j < $count; $j++) {

        }
    }
}
