<?php
/**
 * 选择排序
 *  算法步骤：
 *      1. 与插入排序类似，分为已排序分区和未排序分区
 *      2. 每次从未排序分区中获得最小的元素，放到已排序分区最后的位置
 *      3. 持续2的操作，一直到未排序分区的元素未空
 *
 *   选择排序的复杂度
 *      最好、最坏，平均都是O(n2)
 *
 *   选择排序不是稳定算法，例如 252134，第一次排序的时候已经将第一个2交换位置了。
 */
function selectSort(&$nums)
{
    $count = count($nums);
    $tmp = [];
    for ($i = 0; $i < $count; $i++) {

        $minIndex = $i;
        for ($j = $i + 1; $j < $count; $j++) {
            if ($nums[$minIndex] > $nums[$j]) {
                $minIndex = $j;
            }
        }

        // 交换位置
        $tmp = $nums[$i];
        $nums[$i] = $nums[$minIndex];
        $nums[$minIndex] = $tmp;
    }

    print_r(($nums));

    die;
}

$nums = [6, 7, 1, 3, 2, 5, 4];
$rs = selectSort($nums);
print_r($rs);
